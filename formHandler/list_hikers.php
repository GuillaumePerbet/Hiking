<?php

require_once("dbconnect.php");

//get hikers list from database
$req = $pdo->query("SELECT id,last_name,first_name FROM hiker ORDER BY last_name");
$hikers = $req->fetchAll();
$req -> closeCursor();

$response["list"] = "";
$response["select"] = "";

foreach($hikers as $hiker){
    //get excursions registrations for this hiker
    $req = $pdo->prepare(
        "SELECT e.name,e.id
        FROM registration as r
        INNER JOIN excursion as e ON r.excursion_id=e.id
        WHERE r.hiker_id=?"
    );
    $req->execute([$hiker['id']]);
    $excursions = $req->fetchAll();
    $req -> closeCursor();
    //create html list of excursions
    $excursionList =
        "<ul>";
    foreach($excursions as $excursion){
        $excursionList.=
            "<li>
                {$excursion['name']}
                <button onclick='unregister({$hiker['id']},{$excursion['id']})'>Désinscrire</button>
            </li>";
    }
    $excursionList .=
            "<button onclick='showRegistrationModal({$hiker['id']})'>Inscrire</button>
        </ul>";

    //create html table row
    $response["list"].=
        "<tr>
            <td>{$hiker['last_name']} {$hiker['first_name']}</td>
            <td>$excursionList</td>
            <td>
                <button onclick='showDeleteModal({$hiker['id']})'>Supprimer</button>
                <button onclick='showUpdateModal(".json_encode($hiker).")'>Modifier</button>
            </td>
        </tr>";

    //create select option
    $response["select"].="<option value='{$hiker['id']}'> {$hiker['last_name']} {$hiker['first_name']} </option>";
}

echo json_encode($response);