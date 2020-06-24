<?php
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

//check phone
if (isset($_POST["phone"])){
    $phone = check_string($_POST["phone"]);
    if ($phone !== false){
        $params[":phone"] = $phone;
    }else{
        echo "non string phone";
        exit;
    }
}else{
    echo "non set phone";
    exit;
}

//insert new guide in database
$sql = "INSERT INTO guide (first_name, last_name,phone) VALUES (:first_name, :last_name, :phone)";
$req = $pdo ->prepare($sql);
$req -> execute($params);
$req -> closeCursor();

header("Location: ../guide.php");