<?php
$host = "localhost";
$dbname = "hiking";
$user = "root";
$password = "";
$option = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$password,$option);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}