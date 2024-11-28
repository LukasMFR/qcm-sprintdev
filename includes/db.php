<?php
$host = 'localhost';
$dbname = 'qcm';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Fonction pour formater une date avec les mois en français
function formatDateFr($datetime) {
    $moisFr = [
        "January" => "janvier", "February" => "février", "March" => "mars",
        "April" => "avril", "May" => "mai", "June" => "juin",
        "July" => "juillet", "August" => "août", "September" => "septembre",
        "October" => "octobre", "November" => "novembre", "December" => "décembre"
    ];

    $timestamp = strtotime($datetime);
    $moisAnglais = date('F', $timestamp); // Extrait le mois en anglais
    $moisFrancais = $moisFr[$moisAnglais]; // Convertit en français

    return date('d ', $timestamp) . $moisFrancais . date(' Y à H:i:s', $timestamp);
}

?>