<?php

//check if post id match an id from excursion table and delete matching entry
if (isset($_POST["id"])){
    require_once("dbconnect.php");
    require_once("check_data.php");
    $id = check_id($_POST["id"],$pdo,"excursion");
    if ($id!==false){
        $req = $pdo->prepare("DELETE FROM excursion WHERE id=?");
        $req->execute([$id]);
        $req -> closeCursor();
    }
}