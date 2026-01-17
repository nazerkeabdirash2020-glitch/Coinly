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


$sql = "INSERT INTO `users` (login, pass, email) VALUES ('$login', '$pass', '$email')";


if ($conn->query($sql) === TRUE) {
    echo "Успешная регистрация";
} else {
    echo "Ошибка: " . $conn->error;
}

?>