<?php
include '../includes/db.php';

$error_message = null; // Initialiser la variable d'erreur

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Vérifier si le nom d'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $userExists = $stmt->fetchColumn() > 0;

    if ($userExists) {
        $error_message = "Ce nom d'utilisateur est déjà pris. Veuillez en choisir un autre.";
    } else {
        // Insérer l'utilisateur dans la base de données
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $password])) {
            header('Location: login.php');
            exit();
        } else {
            $error_message = "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Inscription</h1>
    <form action="register.php" method="post" class="form-login">
        <?php if ($error_message): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>
    <p>Déjà un compte ? <a href="login.php">Connectez-vous ici</a>.</p>
</body>
</html>