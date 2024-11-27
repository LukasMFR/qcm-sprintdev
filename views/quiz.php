<?php
include '../includes/db.php';

// Récupérer 10 questions aléatoires
$stmt = $pdo->query("SELECT * FROM questions ORDER BY RAND() LIMIT 10");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>QCM - Questions</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Répondez aux questions</h1>
    <form action="results.php" method="post" onsubmit="return validateForm()">
        <?php 
        $numero = 1; // Initialisation du numéro de question
        foreach ($questions as $question): ?>
            <div class="question-block">
                <p><strong>Question <?php echo $numero; ?> : <?php echo htmlspecialchars($question['libelleQ']); ?></strong></p>
                <?php
                // Récupérer les réponses pour la question actuelle
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
        $numero++; // Incrémentation du numéro de question
        endforeach; ?>
        <button type="submit">Valider</button>
    </form>

    <script>
        function validateForm() {
            const radios = document.querySelectorAll("input[type='radio']");
            const groups = new Set();

            // Vérifie que chaque question a une réponse sélectionnée
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