<?php include '../includes/db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>QCM - Accueil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Bienvenue au QCM</h1>
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