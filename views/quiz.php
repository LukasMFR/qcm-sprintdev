<?php
session_start();
include '../includes/db.php';

// Vérification de la connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Récupérer le niveau choisi par l'utilisateur
$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : 'tous';

// Préparer les questions
if ($niveau === '0' || $niveau === '1') {
    $stmt = $pdo->prepare("SELECT * FROM questions WHERE niveau = ? ORDER BY RAND() LIMIT 10");
    $stmt->execute([$niveau]);
} else {
    $stmt = $pdo->query("SELECT * FROM questions ORDER BY RAND() LIMIT 10");
}
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Définir le texte du niveau
$niveauTexte = $niveau === 'tous' ? 'Tous les niveaux' : "Niveau $niveau";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>QCM - Questions</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>QCM - <?php echo htmlspecialchars($niveauTexte); ?></h1>
    <!-- Bouton pour revenir à la page d'accueil -->
    <a href="home.php" class="btn-home">Retour à l'accueil</a>
    <form action="results.php" method="post" onsubmit="return validateForm()">
        <?php 
        $numero = 1; 
        foreach ($questions as $question): ?>
            <div class="question-block">
                <p><strong>Question <?php echo $numero; ?> : <?php echo htmlspecialchars($question['libelleQ']); ?></strong></p>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM reponses WHERE idq = ?");
                $stmt->execute([$question['idq']]);
                $reponses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($reponses as $reponse): ?>
                    <label>
                        <input type="radio" name="question_<?php echo $question['idq']; ?>" value="<?php echo $reponse['idr']; ?>" required>
                        <?php echo htmlspecialchars($reponse['libeller']); ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
        <?php 
        $numero++; 
        endforeach; ?>
        <button type="submit">Valider</button>
    </form>

    <script>
        function validateForm() {
            const radios = document.querySelectorAll("input[type='radio']");
            const groups = new Set();

            radios.forEach((radio) => {
                if (radio.checked) {
                    groups.add(radio.name);
                }
            });

            if (groups.size < <?php echo count($questions); ?>) {
                alert("Vous devez répondre à toutes les questions.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>