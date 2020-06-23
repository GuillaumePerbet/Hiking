<?php
require_once("functions.php");
require_once("../dbconnect.php");
var_dump($_POST);
$params = [];

//check name
if (isset($_POST["name"])){
    $name = check_string($_POST["name"]);
    if ($name !== false){
        $params[":name"] = $name;
    }else{
        //non string name
        exit;
    }
}else{
    //non set name
    exit;
}

//check price
if (isset($_POST["price"])){
    $price = check_number($_POST["price"]);
    if ($price !== false){
        $params[":price"] = $price;
    }else{
        //non positive number price
        exit;
    }
}else{
    //non set price
    exit;
}

//check max hikers
if (isset($_POST["max_hikers"])){
    $max_hikers = check_number($_POST["max_hikers"]);
    if ($max_hikers !== false){
        $params[":max_hikers"] = $max_hikers;
    }else{
        //non positive number max_hikers
        exit;
    }
}else{
    //non set max_hikers
    exit;
}

//check dates
if (isset($_POST["departure_date"]) && isset($_POST["arrival_date"])){
    $departure_date = check_date($_POST["departure_date"]);
    $arrival_date = check_date($_POST["arrival_date"]);
    if ($departure_date === false || $arrival_date === false){
        //not convertible to future dates
        exit;
    }
    if ($departure_date <= $arrival_date){
        $params[":departure_date"] = date('Y-m-d',$departure_date);
        $params[":arrival_date"] = date('Y-m-d',$arrival_date);
    }else{
        //departure after arrival
        exit;
    }
}else{
    //non set date
    exit;
}

//check places
if (isset($_POST["departure_place_id"]) && isset($_POST["arrival_place_id"])){
    $departure_place_id = check_place_id($_POST["departure_place_id"],$pdo);
    $arrival_place_id = check_place_id($_POST["arrival_place_id"],$pdo);
    if ($departure_place_id !== false && $arrival_place_id !== false){
        $params[":departure_place_id"] = $departure_place_id;
        $params[":arrival_place_id"] = $arrival_place_id;
    }else{
        //non existing id
        exit;
    }
}else{
    //non set place
    exit;
}

//check guides
if (isset($_POST["guide_ids"])){
    $guide_ids = [];
    foreach ($_POST["guide_ids"] as $guide_id){
        $guide_id = check_guide_id($guide_id,$pdo);
        if ($guide_id !== false ){
            array_push($guide_ids,$guide_id);
        }else{
            //non existing id
            exit;
        }
    }
}else{
    //no guide selected
    exit;
}

var_dump($params);
var_dump($guide_ids);