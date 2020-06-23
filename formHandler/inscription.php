<?php
require_once("functions.php");
require_once("../dbconnect.php");
$params = [];

//check hiker
if (isset($_POST["hiker_id"])){
    $hiker_id = check_id($_POST["hiker_id"],$pdo,"hiker");

    if ($hiker_id !== false){
        $params[":hiker_id"] = $hiker_id;
    }else{
        echo "non existing id";
        exit;
    }
}else{
    echo "non set hiker";
    exit;
}

//check excursion
if (isset($_POST["excursion_id"])){
    $excursion_id = check_id($_POST["excursion_id"],$pdo,"excursion");

    if ($excursion_id !== false){
        $params[":excursion_id"] = $excursion_id;
    }else{
        echo "non existing id";
        exit;
    }
}else{
    echo "non set excursion";
    exit;
}

//insert new inscription in database
$sql = "INSERT INTO inscription (hiker_id, excursion_id) VALUES (:hiker_id, :excursion_id)";
$req = $pdo ->prepare($sql);
$req -> execute($params);
$req -> closeCursor();

header("Location: ../hiker.php");