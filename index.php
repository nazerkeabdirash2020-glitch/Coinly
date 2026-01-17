<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="regs.css">
</head>
<body>


<div class="wrapper">
<header class="container">
<span class="logo"> 
    <img class = "iml" src="img1.jpeg">
</span>

<nav>
<ul>
<li class="active"><a href="page1.php">Главная</a></li>
<li class="button"><a href="play.php">Играть</a></li>
<li class="button1">Войти</li>
</ul>
</nav>

</header>
</div> 



<div class = "inf">
<form action="reg.php" method="post">
    <h2>Войдите чтобы играть


        
    </h2>
    <br>
    <input type="text" name="login" placeholder="Username" required>
    <br>
    <input type="email" name="email" placeholder="Email" required>
    <br>
    <input type="password" name="pass" placeholder="Password" required>
    <br>
    <input type="password" name="repeatpass" placeholder="Repeat password" required>
    <br>
    <button type="submit">Register</button>
</form>
</div>

<div class = "inf1">
<form action ="log.php" method="post">
    <input type="text" name="login" placeholder="Username" required>
    <br>
    <input type="password" name="pass" placeholder="Password" required>
    <br>
    <button type="submit">Login</button>
    <br>
</form>
</div>

</body>
</html>