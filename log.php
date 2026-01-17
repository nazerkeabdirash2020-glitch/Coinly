<?php
session_start();
require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'], $_POST['pass'])) {
    $login = $_POST['login'];
    $pass  = $_POST['pass'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE login=? AND pass=?");
    $stmt->bind_param("ss", $login, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['login']   = $row['login'];

        header("Location: log.php");
        exit;
    } else {
        $error = "Неверный логин или пароль";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Мой аккаунт | Coinly</title>
    <link rel="stylesheet" href="account.css">
</head>
<body>

<div class="account-card">
    <div class="avatar"></div>

    <h2>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['login']); ?> 👋</h2>

    <div class="progress-block">
        <p>📘 Финансовая грамотность</p>
        <div class="progress-bar">
            <div class="progress-fill" style="width: 10%;"></div>
        </div>

        <p>😰 Уровень стресса</p>
        <div class="progress-bar stress">
            <div class="progress-fill stress-fill" style="width: 0%;"></div>
        </div>
    </div>

<?php 

$user_id = $_SESSION['user_id'];

$sql = "
SELECT 
    COALESCE(knowledge, 0) AS knowledge,
    COALESCE(stress, 0) AS stress
FROM user_progress
WHERE user_id = $user_id
";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$knowledge = 0;
$stress = 0;

if ($user) {
    $knowledge = (int)$user['knowledge'];
    $stress    = (int)$user['stress'];
}

$sql = "SELECT knowledge, stress FROM user_progress WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

   <form action="play.php" method="get">
        <button class="play-btn">▶ Перейти в игру</button>
    </form> 


</body>


<?php
/*
else {
    echo "Неверный логин или пароль";
}
mysqli_close($conn);
*/
?>