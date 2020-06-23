<?php
require_once("functions.php");
var_dump($_POST);
$params = [];

//check name
if (isset($_POST["name"])){
    $name = $_POST["name"];
    if (check_string($name)){
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

//check max_hikers
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

var_dump($params);