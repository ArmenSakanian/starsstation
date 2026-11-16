<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['status' => 'error', 'message' => 'Method not allowed.'], 405);
}

if (!verifyCsrf($_POST['csrf_token'] ?? null)) {
    jsonResponse(['status' => 'error', 'message' => 'Invalid CSRF token.'], 403);
}

if (requestRateLimited('feedback', 5)) {
    jsonResponse(['status' => 'error', 'message' => 'Please wait a moment before sending another message.'], 429);
}

$name = trim((string) ($_POST['name'] ?? ''));
$surname = trim((string) ($_POST['surname'] ?? ''));
$email = strtolower(trim((string) ($_POST['email'] ?? '')));
$tel = trim((string) ($_POST['tel'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));
$language = strtolower(trim((string) ($_POST['language'] ?? 'fr')));
$subscribe = (string) ($_POST['subscribe'] ?? 'false') === 'true';

if ($name === '' || textLength($name) > 120) {
    jsonResponse(['status' => 'error', 'message' => 'Invalid name.'], 422);
}
if ($surname !== '' && textLength($surname) > 120) {
    jsonResponse(['status' => 'error', 'message' => 'Invalid surname.'], 422);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 190) {
    jsonResponse(['status' => 'error', 'message' => 'Invalid email address.'], 422);
}
if ($tel !== '' && textLength($tel) > 40) {
    jsonResponse(['status' => 'error', 'message' => 'Invalid phone number.'], 422);
}
if ($message === '' || textLength($message) > 1000) {
    jsonResponse(['status' => 'error', 'message' => 'Message is empty or too long.'], 422);
}
if (!in_array($language, ['en', 'fr', 'de', 'it'], true)) {
    $language = 'fr';
}

$translations = [
    'en' => [
        'confirmation_subject' => 'Thank you for your feedback',
        'confirmation_body' => 'Thank you for reaching out to us. We have received your message and will get back to you shortly.'
    ],
    'fr' => [
        'confirmation_subject' => 'Merci pour votre retour',
        'confirmation_body' => 'Merci de nous avoir contactés. Nous avons reçu votre message et nous vous répondrons sous peu.'
    ],
    'de' => [
        'confirmation_subject' => 'Vielen Dank für Ihr Feedback',
        'confirmation_body' => 'Vielen Dank, dass Sie uns kontaktiert haben. Wir haben Ihre Nachricht erhalten und werden uns in Kürze bei Ihnen melden.'
    ],
    'it' => [
        'confirmation_subject' => 'Grazie per il tuo messaggio',
        'confirmation_body' => 'Grazie per averci contattato. Abbiamo ricevuto il tuo messaggio e ti risponderemo al più presto.'
    ]
];
$t = $translations[$language];

$allowed = [
    'png' => ['image/png'],
    'jpg' => ['image/jpeg'],
    'jpeg' => ['image/jpeg'],
    'gif' => ['image/gif'],
    'bmp' => ['image/bmp', 'image/x-ms-bmp'],
    'tiff' => ['image/tiff'],
    'pdf' => ['application/pdf'],
    'txt' => ['text/plain'],
    'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip'],
    'odt' => ['application/vnd.oasis.opendocument.text', 'application/zip'],
    'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip'],
    'ods' => ['application/vnd.oasis.opendocument.spreadsheet', 'application/zip'],
    'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/zip'],
    'odp' => ['application/vnd.oasis.opendocument.presentation', 'application/zip']
];
$maxBytes = max(1, (int) envValue('MAX_UPLOAD_MB', '10')) * 1024 * 1024;
$maxFiles = 5;
$uploadRoot = trim((string) envValue('UPLOAD_DIR', 'uploads'), '/\\');
$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . $uploadRoot;

if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
    jsonResponse(['status' => 'error', 'message' => 'Upload directory could not be created.'], 500);
}

$normalizedFiles = [];
if (isset($_FILES['files']) && is_array($_FILES['files']['name'] ?? null)) {
    $count = count($_FILES['files']['name']);
    if ($count > $maxFiles) {
        jsonResponse(['status' => 'error', 'message' => "Maximum {$maxFiles} files are allowed."], 422);
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    for ($i = 0; $i < $count; $i++) {
        $error = (int) ($_FILES['files']['error'][$i] ?? UPLOAD_ERR_NO_FILE);
        if ($error === UPLOAD_ERR_NO_FILE) continue;
        if ($error !== UPLOAD_ERR_OK) {
            jsonResponse(['status' => 'error', 'message' => 'One of the files could not be uploaded.'], 422);
        }

        $tmp = (string) $_FILES['files']['tmp_name'][$i];
        $original = basename((string) $_FILES['files']['name'][$i]);
        $size = (int) $_FILES['files']['size'][$i];
        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $mime = $finfo->file($tmp) ?: 'application/octet-stream';

        if (!isset($allowed[$ext]) || !in_array($mime, $allowed[$ext], true)) {
            jsonResponse(['status' => 'error', 'message' => "Unsupported file type: {$original}"], 422);
        }
        if ($size <= 0 || $size > $maxBytes) {
            jsonResponse(['status' => 'error', 'message' => "File is too large: {$original}"], 422);
        }

        $stored = bin2hex(random_bytes(18)) . '.' . $ext;
        $normalizedFiles[] = [
            'tmp' => $tmp,
            'original' => $original,
            'stored' => $stored,
            'size' => $size,
            'mime' => $mime,
            'absolute' => $uploadDir . DIRECTORY_SEPARATOR . $stored,
            'relative' => $uploadRoot . '/' . $stored,
        ];
    }
}

$db = null;
$movedFiles = [];
try {
    $db = database();
    $db->begin_transaction();

    $stmt = $db->prepare('INSERT INTO contact_submissions (first_name, last_name, phone_number, email, message, language, subscribed) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $subscribedInt = $subscribe ? 1 : 0;
    $stmt->bind_param('ssssssi', $name, $surname, $tel, $email, $message, $language, $subscribedInt);
    $stmt->execute();
    $submissionId = $db->insert_id;
    $stmt->close();

    if ($normalizedFiles) {
        $fileStmt = $db->prepare('INSERT INTO contact_submission_files (submission_id, original_name, stored_name, mime_type, file_size, public_path) VALUES (?, ?, ?, ?, ?, ?)');
        foreach ($normalizedFiles as $file) {
            if (!move_uploaded_file($file['tmp'], $file['absolute'])) {
                throw new RuntimeException('Failed to save uploaded file.');
            }
            $movedFiles[] = $file['absolute'];
            $fileStmt->bind_param('isssis', $submissionId, $file['original'], $file['stored'], $file['mime'], $file['size'], $file['relative']);
            $fileStmt->execute();
        }
        $fileStmt->close();
    }

    if ($subscribe) {
        $source = 'feedback';
        $subscriberStmt = $db->prepare(
            "INSERT INTO newsletter_subscribers (email, language, source, status)
             VALUES (?, ?, ?, 'active')
             ON DUPLICATE KEY UPDATE language = VALUES(language), source = VALUES(source), status = 'active', updated_at = CURRENT_TIMESTAMP"
        );
        $subscriberStmt->bind_param('sss', $email, $language, $source);
        $subscriberStmt->execute();
        $subscriberStmt->close();
    }

    $db->commit();
} catch (Throwable $e) {
    if ($db instanceof mysqli) {
        try { $db->rollback(); } catch (Throwable $ignored) {}
    }
    foreach ($movedFiles as $path) {
        if (is_file($path)) @unlink($path);
    }
    error_log('Feedback storage error: ' . $e->getMessage());
    $messageOut = envBool('APP_DEBUG') ? $e->getMessage() : 'Your message could not be saved.';
    jsonResponse(['status' => 'error', 'message' => $messageOut], 500);
} finally {
    if ($db instanceof mysqli) $db->close();
}

function configureMailer(PHPMailer $mail): void
{
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = (string) envValue('SMTP_HOST', 'mail.infomaniak.com');
    $mail->SMTPAuth = true;
    $mail->Username = (string) envValue('SMTP_USERNAME');
    $mail->Password = (string) envValue('SMTP_PASSWORD');
    $encryption = strtolower((string) envValue('SMTP_ENCRYPTION', 'tls'));
    $mail->SMTPSecure = $encryption === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = (int) envValue('SMTP_PORT', $encryption === 'ssl' ? '465' : '587');
    $mail->setFrom((string) envValue('MAIL_FROM_ADDRESS', 'support@starsstation.ch'), (string) envValue('MAIL_FROM_NAME', 'Stars Station Studio'));
}

try {
    $safeName = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $safeSurname = htmlspecialchars($surname, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $safeEmail = htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $safeTel = htmlspecialchars($tel, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));

    $mail = new PHPMailer(true);
    configureMailer($mail);
    $mail->addAddress((string) envValue('MAIL_TO_ADDRESS', 'support@starsstation.ch'));
    $mail->addReplyTo($email, trim($name . ' ' . $surname));
    $mail->Subject = 'Stars Station Studio — Feedback from ' . $name;
    $mail->isHTML(true);
    $mail->Body = "<div style=\"font-family:Arial,sans-serif;background:#0a0b10;color:#f7f8ff;padding:32px\"><div style=\"max-width:680px;margin:auto;background:#141722;border:1px solid #2a2f40;border-radius:20px;padding:28px\"><h1 style=\"margin-top:0;color:#b7a8ff\">New Stars Station message</h1><p><strong>Name:</strong> {$safeName} {$safeSurname}</p><p><strong>Email:</strong> {$safeEmail}</p><p><strong>Phone:</strong> {$safeTel}</p><p><strong>Language:</strong> " . strtoupper($language) . "</p><div style=\"margin-top:20px;padding-top:20px;border-top:1px solid #2a2f40;line-height:1.6\">{$safeMessage}</div></div></div>";
    $mail->AltBody = "Name: {$name} {$surname}\nEmail: {$email}\nPhone: {$tel}\nLanguage: {$language}\n\n{$message}";
    foreach ($normalizedFiles as $file) {
        if (is_file($file['absolute'])) $mail->addAttachment($file['absolute'], $file['original']);
    }
    $mail->send();

    $confirmation = new PHPMailer(true);
    configureMailer($confirmation);
    $confirmation->addAddress($email, trim($name . ' ' . $surname));
    $confirmation->Subject = $t['confirmation_subject'];
    $confirmation->isHTML(true);
    $confirmation->Body = '<div style="font-family:Arial,sans-serif;background:#0a0b10;color:#f7f8ff;padding:32px"><div style="max-width:680px;margin:auto;background:#141722;border:1px solid #2a2f40;border-radius:20px;padding:28px"><h1 style="color:#b7a8ff">Stars Station Studio</h1><p>' . htmlspecialchars($t['confirmation_body'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p></div></div>';
    $confirmation->AltBody = $t['confirmation_body'];
    $confirmation->send();

    startAppSession();
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    jsonResponse(['status' => 'success', 'message' => 'Message sent successfully.']);
} catch (Exception $e) {
    error_log('Mail error: ' . $e->getMessage());
    $messageOut = envBool('APP_DEBUG') ? $e->getMessage() : 'Your message was saved, but email delivery failed.';
    jsonResponse(['status' => 'error', 'message' => $messageOut], 502);
}
