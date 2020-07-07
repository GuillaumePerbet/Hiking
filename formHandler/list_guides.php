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
            <td>
                <button class='medium-btn trash' onclick='showDeleteModal({$guide['id']})'></button>
                <button class='medium-btn edit' onclick='showUpdateModal(".json_encode($guide).")'></button>
            </td>
            <td>{$guide['last_name']} {$guide['first_name']}</td>
            <td class='phone'>{$guide['phone']}</td>
            <td class='excursion'>$excursionList</td>
            
        </tr>";
}

echo json_encode($response);
