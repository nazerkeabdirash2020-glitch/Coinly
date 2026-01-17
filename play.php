
<?php
session_start();

include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: index.php"); // если не вошёл — редирект на логин
    exit;
}

// Подключаем БД
//include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo '
    <a href="index.php">Войдите или зарегистрируйтесь</a>
    ';
}

$user_id = $_SESSION['user_id'];

// Получаем данные пользователя
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT login FROM users WHERE user_id=$user_id");

$sql = "SELECT login FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

// 3. ПРОВЕРЯЕМ, УСПЕШЕН ЛИ ЗАПРОС
if ($result === false) {
    die("Ошибка SQL запроса: " . mysqli_error($conn));
}

// 4. Проверяем, есть ли данные
if (mysqli_num_rows($result) === 0) {
    die("Пользователь не найден в базе данных");
}

// 5. Только теперь получаем данные
$user = mysqli_fetch_assoc($result);

//$stmt->bind_param("i", $user_id);
//$stmt->execute();
//$result = $stmt->get_result();
//$user = $result->fetch_assoc();



$sql = "
SELECT 
    COALESCE(money, 0)      AS money,
    COALESCE(stress, 0)     AS stress,
    COALESCE(knowledge, 0)  AS knowledge,
    COALESCE(loans, 0)      AS loans,
    COALESCE(reputation, 0) AS reputation
FROM user_progress
WHERE user_id = $user_id";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $stats = mysqli_fetch_assoc($result);
} else {
    // если записей нет — нули
    $stats = [
        'money' => 500,
        'stress' => 0,
        'knowledge' => 0,
        'loans' => 0,
        'reputation' => 0
    ];

    // создаём строку в БД ОДИН РАЗ
    mysqli_query($conn, "
        INSERT INTO user_progress (user_id, money, stress, knowledge, loans, reputation)
        VALUES ($user_id, 500, 0, 0, 0, 0)
    ");
}

$money     = (int)$stats['money'];
$stress    = (int)$stats['stress'];
$knowledge = (int)$stats['knowledge'];
$loans     = (int)$stats['loans'];
$reputation = (int)$stats['reputation'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coinly играть</title>
    <link rel="stylesheet" href="play.css">
</head>
<body>

<div class="sidebar-menu">
    <div class="user-info">
        <span class="username"><?php echo htmlspecialchars($user['login']); ?></span>
    </div>
    <nav class="menu-links">
        <a href="page1.php">Главная</a>
        <a href="log.php">Мой аккаунт</a>
    </nav>
</div>

<div class="scene" id="scene"></div>

    <div class="stats">

    <div class="stat">
        💰 <span id="money"><?= $money ?></span> $
    </div>

    <div class="stat">
        😰 <span id="stress"><?= $stress ?></span> %
    </div>

    <div class="stat">
        📘 <span id="knowledge"><?= $knowledge ?></span> / 100
    </div>

    <div class="stat">
        ⭐ <span id="reputation"><?= $reputation ?></span>
    </div>

    <div class="stat">
        🕳 <span id="loans"><?= $loans ?></span>
    </div>

    <div id="statNotification" class="stat-notification"></div>


</div>

</div>

<div class="scene" id="scene"></div>

<div class="ui">
    <div class="game-container">

        <div class="story-box">
            <p id="storyText">Добро пожаловать в Coinly.</p>
        </div>

        <div class="buttons">
            <button id="playBtn">Играть</button>
            <button id="nextBtn" style="display:none;">Далее</button>
        </div>

    </div>
</div>

<div class="gender-selection" id="genderSelection">
    <p>Выбери свой пол:</p>
    <button id="maleBtn">Мужской</button>
    <button id="femaleBtn">Женский</button>
</div>

<!--
<div class="gender-selection" id="genderSelection" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    z-index: 9999;
">
    <p style="color: white; font-size: 24px;">Выбери свой пол:</p>
    <button id="maleBtn" style="
        background: #50C878;
        color: white;
        padding: 15px 30px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        margin: 10px;
        cursor: pointer;
        z-index: 10000;
    ">Мужской</button>
    <button id="femaleBtn" style="
        background: #50C878;
        color: white;
        padding: 15px 30px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        margin: 10px;
        cursor: pointer;
        z-index: 10000;
    ">Женский</button>
</div>
-->

<div id="statNotification" class="stat-notification"></div>

<script src="play.js"></script>
</body>
</html>
