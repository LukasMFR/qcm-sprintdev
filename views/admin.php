<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}

$search = $_GET['search'] ?? '';

// Récupérer les résultats avec un filtre sur le nom d'utilisateur
$stmt = $pdo->prepare("SELECT results.*, users.username FROM results JOIN users ON results.user_id = users.id WHERE users.username LIKE ? ORDER BY results.created_at DESC");
$stmt->execute(['%' . $search . '%']);
$results = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container-admin">
        <!-- Bouton retour à l'accueil -->
        <a href="home.php" class="btn-home">Retour à l'accueil</a>

        <h1 class="title-admin">Espace admin - Résultats des utilisateurs</h1>

        <!-- Formulaire de recherche -->
        <form action="admin.php" method="get" class="form-admin">
            <input type="text" name="search" placeholder="Rechercher un utilisateur" value="<?php echo htmlspecialchars($search); ?>" class="search-admin">
            <button type="submit" class="btn-search">Rechercher</button>
        </form>

        <!-- Tableau des résultats -->
        <table class="table-admin">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Score</th>
                    <th>Questions totales</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                <tr>
                    <td><?php echo htmlspecialchars($result['username']); ?></td>
                    <td><?php echo $result['score']; ?>/20</td>
                    <td><?php echo $result['total_questions']; ?></td>
                    <td><?php echo formatDateFr($result['created_at']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>