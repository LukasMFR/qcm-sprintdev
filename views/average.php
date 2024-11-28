<?php
session_start();
include '../includes/db.php';

// Vérification de la connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Calcul de la moyenne
$stmt = $pdo->prepare("SELECT AVG(score) AS average_score FROM results WHERE user_id = ?");
$stmt->execute([$user_id]);
$average = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma moyenne</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container-average">
        <h1 class="title-average">Ma moyenne</h1>
        <p class="text-average">Votre moyenne est de : <span class="score-average"><?php echo round($average, 2); ?>/20</span></p>
        <a href="home.php" class="btn-home">Retour à l'accueil</a>
    </div>
</body>
</html>