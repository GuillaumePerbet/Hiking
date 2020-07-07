<?php
session_start();
if (!isset($_SESSION["user"])){
    header("Location:../index.php");
}

require_once("check_data.php");
require_once("dbconnect.php");
$params = [];
$response=[];

//check if post id match an id from guide table
if (isset($_POST["id"])){
    $id = check_id($_POST["id"],$pdo,"guide");
    if ($id!==false){
        $params[":id"] = $id;
    }else{
        $response["idError"] = "Guide inexistant";
    }
}

//check first name
if (isset($_POST["first_name"])){
    $first_name = check_name($_POST["first_name"]);
    if ($first_name !== false){
        $params[":first_name"] = $first_name;
    }else{
        $response["firstNameError"] = "Veuillez préciser un prénom";
    }
}else{
    $response["firstNameError"] = "Aucun prénom n'a été soumis";
}

//check last name
if (isset($_POST["last_name"])){
    $last_name = check_name($_POST["last_name"]);
    if ($last_name !== false){
        $params[":last_name"] = $last_name;
    }else{
        $response["lastNameError"] = "Veuillez préciser un nom";
    }
}else{
    $response["lastNameError"] = "Aucun nom n'a été soumis";
}

//check phone
if (isset($_POST["phone"])){
    $phone = check_phone($_POST["phone"]);
    if ($phone !== false){
        $params[":phone"] = $phone;
    }else{
        $response["phoneError"] = "Téléphone non valide";
    }
}else{
    $response["phoneError"] = "Aucun numéro de téléphone n'a été soumis";
}

//if errors in submitted values, stop algorithm here
if (!empty($response)){
    echo json_encode($response);
    exit;
}

//update guide in database
$sql = "UPDATE guide SET last_name=:last_name, first_name=:first_name, phone=:phone WHERE id=:id";
$req = $pdo ->prepare($sql);
$req -> execute($params);
$req -> closeCursor();

$response["updateSuccess"] = "Guide ".htmlentities($first_name)." ".htmlentities($last_name)." modifié";

echo json_encode($response);