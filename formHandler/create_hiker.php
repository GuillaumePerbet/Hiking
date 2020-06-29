<?php
session_start();
if (!isset($_SESSION["user"])){
    header("Location:../index.php");
}

require_once("functions.php");
require_once("../dbconnect.php");
$params = [];
$response=[];

//check first name
if (isset($_POST["first_name"])){
    $first_name = check_string($_POST["first_name"]);
    if ($first_name !== false){
        $params[":first_name"] = $first_name;
    }else{
        $response["firstNameError"] = "Le prénom ne doit pas être vide";
    }
}else{
    $response["firstNameError"] = "Aucun prénom n'a été soumis";
}

//check last name
if (isset($_POST["last_name"])){
    $last_name = check_string($_POST["last_name"]);
    if ($last_name !== false){
        $params[":last_name"] = $last_name;
    }else{
        $response["lastNameError"] = "Le nom ne doit pas être vide";
    }
}else{
    $response["lastNameError"] = "Aucun nom n'a été soumis";
}

//if errors in submitted values, stop algorithm here
if (!empty($response)){
    echo json_encode($response);
    exit;
}

//insert new hiker in database
$sql = "INSERT INTO hiker (first_name, last_name) VALUES (:first_name, :last_name)";
$req = $pdo ->prepare($sql);
$req -> execute($params);
$req -> closeCursor();

$response["createSuccess"] = "$first_name $last_name est désormais membre";

echo json_encode($response);