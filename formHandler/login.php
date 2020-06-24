<?php
session_start();
require_once("functions.php");
require_once("../dbconnect.php");

//check name
if (isset($_POST["user"])){
    $user = check_string($_POST["user"]);
    if ($user === false){
        echo "non string user";
        exit;
    }
}else{
    echo "non set user";
    exit;
}

//check and hash password
if (isset($_POST["password"])){
    $password = check_string($_POST["password"]);
    if ($password === false){
        echo "non string password";
        exit;
    }
}else{
    echo "non set password";
    exit;
}

//check if login is correct
$sql = "SELECT user, password FROM admin WHERE user=?";
$req = $pdo ->prepare($sql);
$req -> execute([$user]);
$response = $req -> fetch();
if ($response){
    if(password_verify($password,$response["password"])){
        $_SESSION["user"] = $response["user"];
        $_SESSION["login"] = true;
    }
}else{
    echo "utilisateur inconnu";
}
$req -> closeCursor();

header("Location: ../index.php");