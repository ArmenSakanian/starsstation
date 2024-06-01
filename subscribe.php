<?php
$servername = "sq7p9v.myd.infomaniak.com";
$username = "sq7p9v_sakanian"; 
$password = "Armen7725"; 
$dbname = "sq7p9v_sakanian"; 

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из запроса
$email = $_POST['email'];

if (!empty($email)) {
    $sql = "INSERT INTO sq7p9v_sakanian (email) VALUES ('$email')"; // Используйте правильное имя таблицы
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message_id" => "email_added_successfully"]);
    } else {
        echo json_encode(["message_id" => "email_add_error"]);
    }
} else {
    echo json_encode(["message_id" => "invalid_email"]);
}

$conn->close();
?>
