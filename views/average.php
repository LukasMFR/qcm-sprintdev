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

// Récupérer tous les résultats de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM results WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$results = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes résultats</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container-results">
        <h1 class="title-results">Mes résultats</h1>
        
        <!-- Affichage de la moyenne -->
        <p class="text-average">
            Votre moyenne est de : <span class="score-average"><?php echo round($average, 2); ?>/20</span>
        </p>

        <!-- Tableau des résultats -->
        <table class="table-results">
            <thead>
                <tr>
                    <th>Score</th>
                    <th>Questions totales</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                <tr>
                    <td class="score-cell"><?php echo $result['score']; ?>/20</td>
                    <td><?php echo $result['total_questions']; ?></td>
                    <td><?php echo formatDateFr($result['created_at']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Bouton retour à l'accueil -->
        <a href="home.php" class="btn-home">Retour à l'accueil</a>
    </div>
</body>
</html>