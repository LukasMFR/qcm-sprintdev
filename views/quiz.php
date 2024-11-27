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
    <form action="results.php" method="post">
        <?php foreach ($questions as $question): ?>
            <div>
                <p><strong><?php echo htmlspecialchars($question['libelleQ']); ?></strong></p>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM reponses WHERE idq = ?");
                $stmt->execute([$question['idq']]);
                $reponses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($reponses as $reponse): ?>
                    <label>
                        <input type="radio" name="question_<?php echo $question['idq']; ?>" value="<?php echo $reponse['idr']; ?>">
                        <?php echo htmlspecialchars($reponse['libeller']); ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <button type="submit">Valider</button>
    </form>
</body>
</html>