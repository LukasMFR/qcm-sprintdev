<?php
include '../includes/db.php';

$score = 0;
foreach ($_POST as $question_id => $answer_id) {
    if (strpos($question_id, 'question_') === 0) {
        $stmt = $pdo->prepare("SELECT verite FROM reponses WHERE idr = ?");
        $stmt->execute([$answer_id]);
        $isCorrect = $stmt->fetchColumn();
        if ($isCorrect) {
            $score += 2;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>QCM - Résultats</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Résultats</h1>
    <p>Votre score est de : <?php echo $score; ?>/20</p>
    <p>Correction :</p>
    <ul>
        <?php foreach ($_POST as $question_id => $answer_id): 
            if (strpos($question_id, 'question_') === 0) {
                $questionId = str_replace('question_', '', $question_id);

                $stmt = $pdo->prepare("SELECT libelleQ FROM questions WHERE idq = ?");
                $stmt->execute([$questionId]);
                $questionText = $stmt->fetchColumn();

                $stmt = $pdo->prepare("SELECT libeller, verite FROM reponses WHERE idr = ?");
                $stmt->execute([$answer_id]);
                $response = $stmt->fetch(PDO::FETCH_ASSOC);

                // Classe CSS pour le style (vert ou rouge)
                $resultClass = $response['verite'] ? 'correct' : 'incorrect';

                echo "<li class='$resultClass'><strong>$questionText</strong><br>";
                echo "Votre réponse : " . htmlspecialchars($response['libeller']) . "</li>";
            }
        endforeach; ?>
    </ul>

    <form action="quiz.php" method="post">
        <button type="submit">Refaire un QCM</button>
    </form>
</body>
</html>