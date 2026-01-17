<?php
session_start();
require_once('db.php');

$login = $_POST["login"];
$pass = $_POST["pass"];
$repeatpass = $_POST["repeatpass"];
$email = $_POST["email"];

if ($pass !== $repeatpass) {
    die("Пароли не совпадают");
}

// ХЭШИРУЕМ пароль
//$passHash = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO `users` (login, pass, email) VALUES ('$login', '$pass', '$email')";
//$conn->query($sql);
//echo $conn;

if ($conn->query($sql) === TRUE) {
    echo "Успешная регистрация";
} else {
    echo "Ошибка: " . $conn->error;
}

?>