<?php
declare(strict_types=1);
require __DIR__ . '/config/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['status' => 'error', 'message_id' => 'invalid_email', 'message' => 'Method not allowed.'], 405);
}

if (!verifyCsrf($_POST['csrf_token'] ?? null)) {
    jsonResponse(['status' => 'error', 'message' => 'Invalid CSRF token.'], 403);
}

if (requestRateLimited('subscribe', 3)) {
    jsonResponse(['status' => 'error', 'message' => 'Please wait a moment before trying again.'], 429);
}

$email = strtolower(trim((string) ($_POST['email'] ?? '')));
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 190) {
    jsonResponse(['status' => 'error', 'message_id' => 'invalid_email', 'message' => 'Invalid email address.'], 422);
}

$language = strtolower(trim((string) ($_POST['language'] ?? '')));
if (!in_array($language, ['en', 'fr', 'de', 'it'], true)) {
    $language = 'fr';
}

try {
    $db = database();
    $stmt = $db->prepare(
        "INSERT INTO newsletter_subscribers (email, language, source, status)
         VALUES (?, ?, 'footer', 'active')
         ON DUPLICATE KEY UPDATE language = VALUES(language), status = 'active', updated_at = CURRENT_TIMESTAMP"
    );
    $stmt->bind_param('ss', $email, $language);
    $stmt->execute();
    $stmt->close();
    $db->close();

    jsonResponse(['status' => 'success', 'message_id' => 'email_added_successfully']);
} catch (Throwable $e) {
    error_log('Subscribe error: ' . $e->getMessage());
    $message = envBool('APP_DEBUG') ? $e->getMessage() : 'Subscription could not be saved.';
    jsonResponse(['status' => 'error', 'message_id' => 'email_add_error', 'message' => $message], 500);
}
