<?php
session_start();
if (!isset($_SESSION["user"])){
    header("Location:../index.php");
}

require_once("check_data.php");
require_once("dbconnect.php");
$params = [];
$response=[];

//check hiker
if (isset($_POST["hiker_id"])){
    $hiker_id = check_id($_POST["hiker_id"],$pdo,"hiker");

    if ($hiker_id !== false){
        $params[":hiker_id"] = $hiker_id;
    }else{
        $response["hikerError"] = "Membre inexistant";
    }
}else{
    $response["hikerError"] = "veuillez préciser le membre";
}

//check excursion
if (isset($_POST["excursion_id"])){
    $excursion_id = check_id($_POST["excursion_id"],$pdo,"excursion");

    if ($excursion_id !== false){
        $params[":excursion_id"] = $excursion_id;
    }else{
        $response["excursionError"] = "Excursion inexistante";
    }
}else{
    $response["excursionError"] = "Veuillez préciser l'excursion";
}

//if errors in submitted values, stop algorithm here
if (!empty($response)){
    echo json_encode($response);
    exit;
}

//remove registration from table
$req = $pdo->prepare("DELETE FROM registration WHERE hiker_id=:hiker_id AND excursion_id=:excursion_id");
$req->execute($params);
$req -> closeCursor();