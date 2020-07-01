<?php

//check if post id match an id from guide table and delete matching entry
if (isset($_POST["id"])){
    require_once("dbconnect.php");
    require_once("check_data.php");
    $id = check_id($_POST["id"],$pdo,"guide");
    if ($id!==false){
        $req = $pdo->prepare("DELETE FROM guide WHERE id=?");
        $req->execute([$id]);
        $req -> closeCursor();
    }
}