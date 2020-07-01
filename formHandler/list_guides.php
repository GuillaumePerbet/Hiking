<?php

require_once("dbconnect.php");

//get guides list from database
$req = $pdo->query("SELECT id,last_name,first_name,phone FROM guide ORDER BY last_name");
$guides = $req->fetchAll();
$req -> closeCursor();

$response["content"] = "";
foreach($guides as $guide){
    //get excursions accompany by this guide
    $req = $pdo->prepare(
        "SELECT e.name
        FROM accompany as a
        INNER JOIN excursion as e ON a.excursion_id=e.id
        WHERE a.guide_id=?"
    );
    $req->execute([$guide['id']]);
    $excursions = $req->fetchAll();
    $req -> closeCursor();
    //create html list of excursions
    $excursionList = "<ul>";
    foreach($excursions as $excursion){
        $excursionList.="<li>{$excursion['name']}</li>";
    }
    $excursionList .= "</ul>";

    //create html table row
    $response["content"].=
        "<tr>
            <td>{$guide['last_name']} {$guide['first_name']}</td>
            <td>{$guide['phone']}</td>
            <td>$excursionList</td>
            <td><button onclick='showModal({$guide['id']})'>Supprimer</button></td>
        </tr>";
}

echo json_encode($response);
