<?php
session_start();
include '../includes/db.php';

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>QCM - Accueil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="average.php">Ma moyenne</a></li>
            <?php if ($_SESSION['is_admin']): ?>
                <li><a href="admin.php">Espace admin</a></li>
            <?php endif; ?>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>
    <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?> !</h1>
    <form action="quiz.php" method="get" class="niveau-form">
        <label for="niveau">Choisissez un niveau :</label>
        <select name="niveau" id="niveau" required>
            <option value="tous">Tous les niveaux</option>
            <option value="0">Niveau 0</option>
            <option value="1">Niveau 1</option>
        </select>
        <button type="submit">Commencer le QCM</button>
    </form>
</body>
</html>