<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

header('Content-Type: application/json'); // Устанавливаем заголовок для ответа JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $response = [];

    // Проверка токена CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $response['status'] = 'error';
        $response['message'] = 'Invalid CSRF token';
        echo json_encode($response);
        exit();
    }

    // Валидация данных
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $tel = filter_var(trim($_POST['tel']), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['status'] = 'error';
        $response['message'] = 'Invalid email format';
        echo json_encode($response);
        exit();
    }

    // Подключение к базе данных
    $servername = "sq7p9v.myd.infomaniak.com";
    $username = "sq7p9v_sakanian"; 
    $password = "Armen7725"; 
    $dbname = "sq7p9v_sakanian"; // Имя базы данных

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        $response['status'] = 'error';
        $response['message'] = 'Database connection failed';
        echo json_encode($response);
        exit();
    }

    // Подготовка данных для вставки в базу данных
    $file_urls = [];
    $uploadDir = 'file/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    if (!empty($_FILES['files']['name'][0])) {
        foreach ($_FILES['files']['name'] as $key => $value) {
            if ($_FILES['files']['error'][$key] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['files']['tmp_name'][$key];
                $fileName = basename($_FILES['files']['name'][$key]);
                $uploadFilePath = $uploadDir . $fileName;
                $fileUrl = 'https://starsstation.ch/file/' . $fileName;

                if (move_uploaded_file($tmp_name, $uploadFilePath)) {
                    $file_urls[] = $fileUrl;
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Failed to upload file';
                    echo json_encode($response);
                    exit();
                }
            }
        }
    }

    $file_urls_string = implode(", ", $file_urls);

    // SQL запрос для вставки данных в таблицу form_submissions
    $stmt = $conn->prepare("INSERT INTO form_submissions (first_name, last_name, phone_number, email, message, file_url) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $surname, $tel, $email, $message, $file_urls_string);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Data saved successfully';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Data saving failed';
        echo json_encode($response);
        exit();
    }

    $stmt->close();
    $conn->close();

    // Отправка письма
    $language = $_POST['language'] ?? 'en'; // Получаем язык из POST данных или используем 'en' по умолчанию
    $translations = [
        'en' => [
            'support' => 'Support',
            'subject_prefix' => 'Support Stars Station Studio',
            'confirmation_subject' => 'Thank you for your feedback',
            'confirmation_body' => "Dear {name},\n\nThank you for reaching out to us. We have received your message and will get back to you shortly.\n\nBest regards,\nSupport Team"
        ],
        'fr' => [
            'support' => 'Soutien',
            'subject_prefix' => 'Support Stars Station Studio',
            'confirmation_subject' => 'Merci pour votre retour',
            'confirmation_body' => "Cher {name},\n\nMerci de nous avoir contactés. Nous avons reçu votre message et nous vous répondrons sous peu.\n\nCordialement,\nL'équipe de support"
        ],
        'de' => [
            'support' => 'Unterstützung',
            'subject_prefix' => 'Support Stars Station Studio',
            'confirmation_subject' => 'Vielen Dank für Ihr Feedback',
            'confirmation_body' => "Sehr geehrter {name},\n\nVielen Dank, dass Sie uns kontaktiert haben. Wir haben Ihre Nachricht erhalten und werden uns in Kürze bei Ihnen melden.\n\nMit freundlichen Grüßen,\nSupport-Team"
        ],
    ];

    $selectedTranslations = $translations[$language] ?? $translations['en'];

    try {
        $mail = new PHPMailer(true);

        // Установка кодировки
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // Настройка SMTP
        $mail->isSMTP();
        $mail->Host = 'mail.infomaniak.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'support@starsstation.ch'; // SMTP username
        $mail->Password = 'Panter7yuri'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Отправитель
        $mail->setFrom('support@starsstation.ch', $selectedTranslations['support']);

        // Получатель
        $mail->addAddress('support@starsstation.ch', 'Support');

        // Тема письма
        $mail->Subject = 'Support Stars Station Studio - Feedback from ' . $name;

        // Текст письма в HTML формате
        $bodyContent = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                }
                .container {
                    width: 80%;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #f9f9f9;
                    border: 1px solid #ddd;
                }
                .header {
                    text-align: center;
                    padding-bottom: 20px;
                }
                .header h1 {
                    color: #0073aa;
                }
                .content {
                    margin-bottom: 20px;
                }
                .footer {
                    text-align: center;
                    padding-top: 20px;
                    border-top: 1px solid #ddd;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Support Stars Station Studio</h1>
                </div>
                <div class='content'>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Surname:</strong> $surname</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Telephone:</strong> $tel</p>
                    <p><strong>Message:</strong> $message</p>
                </div>
                <div class='footer'>
                    <p>Thank you for reaching out to us!</p>
                </div>
            </div>
        </body>
        </html>";

        $mail->isHTML(true);  // Устанавливаем формат письма в HTML
        $mail->Body = $bodyContent;

        // Прикрепление файлов
        foreach ($file_urls as $file_url) {
            $mail->addAttachment($uploadDir . basename($file_url), basename($file_url));
        }

        // Отправка письма
        $mail->send();

        // Отправка подтверждающего письма
        $confirmationMail = new PHPMailer(true);
        $confirmationMail->CharSet = 'UTF-8';
        $confirmationMail->Encoding = 'base64';
        $confirmationMail->isSMTP();
        $confirmationMail->Host = 'mail.infomaniak.com';
        $confirmationMail->SMTPAuth = true;
        $confirmationMail->Username = 'support@starsstation.ch';
        $confirmationMail->Password = 'Panter7yuri';
        $confirmationMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $confirmationMail->Port = 587;
        $confirmationMail->setFrom('support@starsstation.ch', 'Stars Station Support');
        $confirmationMail->addAddress($email, $name);
        $confirmationMail->Subject = $selectedTranslations['confirmation_subject'];

        // Подтверждающее письмо в HTML формате
        $confirmationBody = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                }
                .container {
                    width: 80%;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #f9f9f9;
                    border: 1px solid #ddd;
                }
                .header {
                    text-align: center;
                    padding-bottom: 20px;
                }
                .header h1 {
                    color: #0073aa;
                }
                .content {
                    margin-bottom: 20px;
                }
                .footer {
                    text-align: center;
                    padding-top: 20px;
                    border-top: 1px solid #ddd;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Support Stars Station Studio</h1>
                </div>
                <div class='content'>
                    <p>Dear {name},</p>
                    <p>Thank you for your message. We have received it and will get back to you shortly.</p>
                    <p>Best regards,</p>
                    <p>Support Team</p>
                </div>
            </div>
        </body>
        </html>";

        $confirmationMail->isHTML(true);  // Устанавливаем формат письма в HTML
        $confirmationMail->Body = str_replace('{name}', $name, $confirmationBody);
        $confirmationMail->send();

        $response['status'] = 'success';
        $response['message'] = 'Mail Sent Successfully';
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Mail Sending Failed';
    }
    echo json_encode($response);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request']);
}
?>
