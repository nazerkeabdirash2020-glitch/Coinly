<?php
session_start();

// Уничтожаем сессию
session_unset();
session_destroy();

// Редирект на главную страницу
header("Location: page1.php");
exit;