
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coinly - игра по финансовой грамотности</title>
    <link rel="stylesheet" href="coins.css">
</head>
<body>
<div class="wrapper">
<header class="container">
<span class="logo"> 
    <img class = "iml" src="img1.jpeg">
</span>

<?php if (isset($_SESSION['user_id'])): ?>

<nav>
<ul>
<li class="active">Главная</li>
<li class="button"><a href="play.php">Играть</a></li>
<li class="button"><a href="http://localhost/coinly/logout.php">Выйти</a></li>
<img src="avatar.png" alt="Аватар" style="width:30px; height:30px; border-radius:50%; margin-right:8px;">
</ul>
</nav>

 <?php else: ?>

<nav>
<ul>
<li class="active">Главная</li>
<li class="button"><a href="play.php">Играть</a></li>
<li class="button"><a href="http://localhost/coinly/index.php">Войти</a></li>
</ul>
</nav>

<?php endif; ?>

</header>
</div> 

<div class="hero--info">
<h1>Добро пожаловать на сайт игры Coinly!</h1>
<br>
<p>Coinly - современная онлайн-игра, в которой твои решения определяют твоё финансовое будущее. Ты начинаешь путь обычным персонажем в живом мире — с мечтами, целями и ограниченными ресурсами. Шаг за шагом ты учишься зарабатывать, тратить, копить, инвестировать и управлять рисками, сталкиваясь с ситуациями, максимально приближенными к реальной жизни. Каждый выбор имеет последствия.</p>
<br>
<button class="button"><a href="play.php">Играть в Coinly</a></button>
</div>

</body>
</html>