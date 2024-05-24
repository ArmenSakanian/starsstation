<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

header('Content-Type: application/json'); // Устанавливаем заголовок для ответа JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $response = []; // Массив для хранения ответа

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
        $mail->setFrom('support@starsstation.ch', 'Webmaster');

        // Получатель
        $mail->addAddress('support@starsstation.ch', 'Support');

        // Тема письма
        $mail->Subject = 'Feedback from ' . $name;

        // Текст письма
        $bodyContent = "Name: $name\n";
        $bodyContent .= "Surname: $surname\n";
        $bodyContent .= "Email: $email\n";
        $bodyContent .= "Telephone: $tel\n";
        $bodyContent .= "Message: $message\n";
        $mail->Body = $bodyContent;

        // Прикрепление файлов, если они есть
        if (!empty($_FILES['files']['name'][0])) {
            foreach ($_FILES['files']['name'] as $key => $value) {
                if ($_FILES['files']['error'][$key] == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES['files']['tmp_name'][$key];
                    $name = $_FILES['files']['name'][$key];
                    $mail->addAttachment($tmp_name, $name);
                }
            }
        }

        // Отправка письма
        $mail->send();
        $response['status'] = 'success';
        $response['message'] = 'Mail Sent Successfully';
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Mail Sending Failed. Error: ' . $mail->ErrorInfo;
    }
    echo json_encode($response);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request']);
}
?>g