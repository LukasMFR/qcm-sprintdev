<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT AVG(score) AS average_score FROM results WHERE user_id = ?");
$stmt->execute([$user_id]);
$average = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma moyenne</title>
</head>
<body>
    <h1>Ma moyenne</h1>
    <p>Votre moyenne est de : <?php echo round($average, 2); ?>/20</p>
</body>
</html>