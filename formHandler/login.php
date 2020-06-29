<?php
session_start();
require_once("functions.php");
require_once("../dbconnect.php");
$response = [];

//check name
if (isset($_POST["user"])){
    $user = check_string($_POST["user"]);
    if ($user === false){
        $response["userError"] = "Veuillez préciser un nom d'utilisateur";
    }
}else{
    $response["userError"] = "Aucun nom d'utilisateur n'a été soumis";
}

//check and hash password
if (isset($_POST["password"])){
    $password = check_string($_POST["password"]);
    if ($password === false){
        $response["passwordError"] = "Veuillez entrer le mot de passe";
    }
}else{
    $response["passwordError"] = "Aucun mot de passe n'a été soumis";
}

//if errors in submitted values, stop algorithm here
if (!empty($response)){
    echo json_encode($response);
    exit;
}

//check if login is correct
$sql = "SELECT user, password FROM admin WHERE user=?";
$req = $pdo ->prepare($sql);
$req -> execute([$user]);
$res = $req -> fetch();
//check user
if ($res){
    //check password
    if(password_verify($password,$res["password"])){
        $_SESSION["user"] = $res["user"];
        $response["user"] = $res["user"];
    }else{
        $response["passwordError"] = "Mot de passe incorrect";
    }
}else{
    $response["userError"] = "Nom d'utilisateur inconnu";
}
$req -> closeCursor();

echo json_encode($response);