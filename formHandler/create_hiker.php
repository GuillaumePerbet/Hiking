<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"]===false){
    echo "Vous n'êtes pas connecté";
    exit;
}

require_once("functions.php");
require_once("../dbconnect.php");
$params = [];

//check first name
if (isset($_POST["first_name"])){
    $first_name = check_string($_POST["first_name"]);
    if ($first_name !== false){
        $params[":first_name"] = $first_name;
    }else{
        echo "non string first name";
        exit;
    }
}else{
    echo "non set first name";
    exit;
}

//check last name
if (isset($_POST["last_name"])){
    $last_name = check_string($_POST["last_name"]);
    if ($last_name !== false){
        $params[":last_name"] = $last_name;
    }else{
        echo "non string last name";
        exit;
    }
}else{
    echo "non set last name";
    exit;
}

//insert new hiker in database
$sql = "INSERT INTO hiker (first_name, last_name) VALUES (:first_name, :last_name)";
$req = $pdo ->prepare($sql);
$req -> execute($params);
$req -> closeCursor();

header("Location: ../hiker.php");