<?php
require_once(__DIR__ . '/../env/env.php');


try {
    $pdo = new PDO("mysql:host=localhost; dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch (PDOException $e){
    echo 'Probleme mit der Datenbankverbindung: <br>' . $e;
    die();
}

// Alle Bilder aus der DB laden.
$stmt = $pdo->prepare('SELECT * FROM `images` ORDER BY `id` ASC');
$stmt->execute();

$imagesDB = $stmt->fetchAll(PDO::FETCH_ASSOC);