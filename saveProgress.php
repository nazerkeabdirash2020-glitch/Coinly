<?php
session_start();
include 'db.php'; // подключение к БД

// проверяем, что пользователь вошёл
if(!isset($_SESSION['user_id'])){
    echo json_encode(['success' => false, 'message' => 'Не авторизован']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $_SESSION['user_id'];
$level = $data['level'];
$money = $data['money'];
$stress = $data['stress'];
$knowledge = $data['knowledge'];
$loans = $data['loans'];

// проверяем, есть ли уже запись
$stmt = $db->prepare("SELECT * FROM user_progress WHERE user_id=?");
$stmt->execute([$user_id]);
if($stmt->rowCount() > 0){
    // обновляем

    $stmt = $db->prepare("UPDATE user_progress SET level=?, money=?, stress=?, knowledge=?, loans=? WHERE user_id=?");
    $stmt->execute([$level, $money, $stress, $knowledge, $loans, $user_id]);
} else {
    // создаём новую запись
    $stmt = $db->prepare("INSERT INTO user_progress (user_id, level, money, stress, knowledge, loans) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $level, $money, $stress, $knowledge, $loans]);
}

echo json_encode(['success' => true]);
?>