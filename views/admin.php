<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}

$search = $_GET['search'] ?? '';

$stmt = $pdo->prepare("SELECT results.*, users.username FROM results JOIN users ON results.user_id = users.id WHERE users.username LIKE ? ORDER BY results.created_at DESC");
$stmt->execute(['%' . $search . '%']);
$results = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace admin</title>
</head>
<body>
    <h1>Résultats des utilisateurs</h1>
    <form action="admin.php" method="get">
        <input type="text" name="search" placeholder="Rechercher un utilisateur" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Rechercher</button>
    </form>
    <table>
        <tr>
            <th>Utilisateur</th>
            <th>Score</th>
            <th>Questions totales</th>
            <th>Date</th>
        </tr>
        <?php foreach ($results as $result): ?>
        <tr>
            <td><?php echo htmlspecialchars($result['username']); ?></td>
            <td><?php echo $result['score']; ?></td>
            <td><?php echo $result['total_questions']; ?></td>
            <td><?php echo $result['created_at']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>