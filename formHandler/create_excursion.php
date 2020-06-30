<?php
session_start();
if (!isset($_SESSION["user"])){
    header("Location:../index.php");
}

require_once("functions.php");
require_once("dbconnect.php");
$params = [];
$response=[];

//check name
if (isset($_POST["name"])){
    $name = check_string($_POST["name"]);
    if ($name !== false){
        $params[":name"] = $name;
    }else{
        $response["nameError"] = "Veuillez préciser un nom";
    }
}else{
    $response["nameError"] = "Aucun nom n'a été soumis";
}

//check price
if (isset($_POST["price"])){
    $price = check_number($_POST["price"]);
    if ($price !== false){
        $params[":price"] = $price;
    }else{
        $response["priceError"] = "Veuillez entrer un prix valide";
    }
}else{
    $response["priceError"] = "Aucun prix n'a été soumis";
}

//check max hikers
if (isset($_POST["max_hikers"])){
    $max_hikers = check_number($_POST["max_hikers"]);
    if ($max_hikers !== false){
        $params[":max_hikers"] = $max_hikers;
    }else{
        $response["maxHikersError"] = "Veuillez entrer un nombre de places valide";
    }
}else{
    $response["maxHikersError"] = "Aucun nombre de places n'a été soumis";
}

//check dates
if (isset($_POST["departure_date"]) && isset($_POST["arrival_date"])){
    $departure_date = check_date($_POST["departure_date"]);
    $arrival_date = check_date($_POST["arrival_date"]);
    if ($departure_date === false || $arrival_date === false){
        $response["dateError"] = "Veuillez préciser des dates futures";
    }
    if ($departure_date <= $arrival_date){
        $params[":departure_date"] = date('Y-m-d',$departure_date);
        $params[":arrival_date"] = date('Y-m-d',$arrival_date);
    }else{
        $response["dateError"] = "L'arrivée doit se faire après le départ";
    }
}else{
    $response["dateError"] = "Aucune date n'a été soumise";
}

//check places
if (isset($_POST["departure_place_id"]) && isset($_POST["arrival_place_id"])){
    $departure_place_id = check_id($_POST["departure_place_id"],$pdo,'place');
    $arrival_place_id = check_id($_POST["arrival_place_id"],$pdo,'place');
    if ($departure_place_id !== false && $arrival_place_id !== false){
        $params[":departure_place_id"] = $departure_place_id;
        $params[":arrival_place_id"] = $arrival_place_id;
    }else{
        $response["placeError"] = "Région inexistante";
    }
}else{
    $response["placeError"] = "Aucune région n'a été soumise";
}

//check guides
if (isset($_POST["guide_ids"])){
    $guide_ids = [];
    foreach ($_POST["guide_ids"] as $guide_id){
        $guide_id = check_id($guide_id,$pdo,"guide");
        if ($guide_id !== false ){
            array_push($guide_ids,$guide_id);
        }else{
            $response["guidesError"] = "Guide inexistant";
        }
    }
}else{
    $response["guidesError"] = "Aucun guide n'a été séléctionné";
}

//if errors in submitted values, stop algorithm here
if (!empty($response)){
    echo json_encode($response);
    exit;
}

//insert new excursion in database
$sql = "INSERT INTO excursion (name, price, max_hikers, departure_date, arrival_date, departure_place_id, arrival_place_id) VALUES (:name, :price, :max_hikers, :departure_date, :arrival_date, :departure_place_id, :arrival_place_id)";
$req = $pdo ->prepare($sql);
$req -> execute($params);
$req -> closeCursor();

//get the id of inserted excursion
$req = $pdo -> query("SELECT id FROM excursion WHERE id=LAST_INSERT_ID()");
$excursion_id = $req->fetch()["id"];
$req -> closeCursor();

//insert guides into accompany table
foreach ($guide_ids as $guide_id){
    $sql = "INSERT INTO accompany VALUES (?,?)";
    $req = $pdo ->prepare($sql);
    $req -> execute([$guide_id,$excursion_id]);
    $req -> closeCursor();
}

$response["createSuccess"] = "Nouvelle excursion créée";

echo json_encode($response);