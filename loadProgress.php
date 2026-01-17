<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    echo json_encode(['success' => false]);
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $db->prepare("SELECT * FROM user_progress WHERE user_id=?");
$stmt->execute([$user_id]);
$progress = $stmt->fetch(PDO::FETCH_ASSOC);

if($progress){
    echo json_encode([
        'success' => true,
        'level' => $progress['level'],
        'money' => $progress['money'],
        'stress' => $progress['stress'],
        'knowledge' => $progress['knowledge'],
        'loans' => $progress['loans']
    ]);
} else {
    echo json_encode(['success' => true, 'level' => 1, 'money' => 500, 'stress' => 0, 'knowledge' => 0, 'loans' => 0]);
}
?>