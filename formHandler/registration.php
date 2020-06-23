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

//check if hiker already in excursion
$req = $pdo ->query("SELECT hiker_id FROM registration WHERE excursion_id=$excursion_id");
$registrations = $req -> fetchAll();
foreach($registrations as $registration){
    if ($registration["hiker_id"]==$hiker_id){
        echo "already registered hiker";
        exit;
    }
}
$req -> closeCursor();

//check if excursion is full
//fetch actual number of participants
$req = $pdo ->query("SELECT COUNT(hiker_id) as hikers_number FROM registration WHERE excursion_id=$excursion_id");
$hikers_number = $req -> fetch()["hikers_number"];
$req -> closeCursor();
//fetch max number of participants
$req = $pdo ->query("SELECT max_hikers FROM excursion WHERE id=$excursion_id");
$max_hikers = $req -> fetch()["max_hikers"];
$req -> closeCursor();
//compare numbers
if ($hikers_number >= $max_hikers){
    echo "excursion is full";
    exit;
}

//insert new registration in database
$sql = "INSERT INTO registration (hiker_id, excursion_id) VALUES (:hiker_id, :excursion_id)";
$req = $pdo ->prepare($sql);
$req -> execute($params);
$req -> closeCursor();

header("Location: ../hiker.php");