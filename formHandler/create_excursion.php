<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"]===false){
    echo "Vous n'êtes pas connecté";
    exit;
}

require_once("functions.php");
require_once("../dbconnect.php");
$params = [];
$guide_ids = [];

//check name
if (isset($_POST["name"])){
    $name = check_string($_POST["name"]);
    if ($name !== false){
        $params[":name"] = $name;
    }else{
        echo "non string name";
        exit;
    }
}else{
    echo "non set name";
    exit;
}

//check price
if (isset($_POST["price"])){
    $price = check_number($_POST["price"]);
    if ($price !== false){
        $params[":price"] = $price;
    }else{
        echo "non positive number price";
        exit;
    }
}else{
    echo "non set price";
    exit;
}

//check max hikers
if (isset($_POST["max_hikers"])){
    $max_hikers = check_number($_POST["max_hikers"]);
    if ($max_hikers !== false){
        $params[":max_hikers"] = $max_hikers;
    }else{
        echo "non positive number max_hikers";
        exit;
    }
}else{
    echo "non set max_hikers";
    exit;
}

//check dates
if (isset($_POST["departure_date"]) && isset($_POST["arrival_date"])){
    $departure_date = check_date($_POST["departure_date"]);
    $arrival_date = check_date($_POST["arrival_date"]);
    if ($departure_date === false || $arrival_date === false){
        echo "not convertible to future dates";
        exit;
    }
    if ($departure_date <= $arrival_date){
        $params[":departure_date"] = date('Y-m-d',$departure_date);
        $params[":arrival_date"] = date('Y-m-d',$arrival_date);
    }else{
        echo "departure after arrival";
        exit;
    }
}else{
    echo "non set date";
    exit;
}

//check places
if (isset($_POST["departure_place_id"]) && isset($_POST["arrival_place_id"])){
    $departure_place_id = check_id($_POST["departure_place_id"],$pdo,'place');
    $arrival_place_id = check_id($_POST["arrival_place_id"],$pdo,'place');
    if ($departure_place_id !== false && $arrival_place_id !== false){
        $params[":departure_place_id"] = $departure_place_id;
        $params[":arrival_place_id"] = $arrival_place_id;
    }else{
        echo "non existing id";
        exit;
    }
}else{
    echo "non set place";
    exit;
}

//check guides
if (isset($_POST["guide_ids"])){
    foreach ($_POST["guide_ids"] as $guide_id){
        $guide_id = check_id($guide_id,$pdo,"guide");
        if ($guide_id !== false ){
            array_push($guide_ids,$guide_id);
        }else{
            echo "non existing id";
            exit;
        }
    }
}else{
    echo "no guide selected";
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

header("Location: ../excursion.php");