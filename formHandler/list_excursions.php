<?php

require_once("dbconnect.php");

//get excursions list from database
$req = $pdo->query("SELECT id,name,price,max_hikers,departure_date,arrival_date,departure_place_id,arrival_place_id FROM excursion ORDER BY name");
$excursions = $req->fetchAll();
$req -> closeCursor();

$response["list"] = "";
foreach($excursions as $excursion){
    //get excursion guides
    $req = $pdo->prepare(
        "SELECT g.first_name, g.last_name
        FROM excursion AS e
        INNER JOIN accompany AS a ON a.excursion_id=e.id
        INNER JOIN guide AS g ON g.id=a.guide_id
        WHERE e.id=?"
    );
    $req->execute([$excursion["id"]]);
    $guides = $req->fetchAll();
    $req -> closeCursor();
    $guidesList=[];
    foreach($guides as $guide){
        array_push($guidesList,$guide["first_name"]." ".$guide["last_name"]);
    }

    //get places name
    $req = $pdo->prepare("SELECT name FROM place WHERE id=?");
    $req->execute([$excursion["departure_place_id"]]);
    $departure_place = $req->fetch()["name"];
    $req -> closeCursor();

    $req = $pdo->prepare("SELECT name FROM place WHERE id=?");
    $req->execute([$excursion["arrival_place_id"]]);
    $arrival_place = $req->fetch()["name"];
    $req -> closeCursor();

    //get number of participants
    $req = $pdo ->prepare("SELECT COUNT(hiker_id) as hikers_number FROM registration WHERE excursion_id=?");
    $req->execute([$excursion["id"]]);
    $hikers_number = $req -> fetch()["hikers_number"];
    $req -> closeCursor();

    //add html item
    $response["list"].=
        "<div>"
            .$excursion['name']
            .$departure_place
            .$arrival_place
            .$excursion['departure_date']
            .$excursion['arrival_date']
            .$guidesList[0]
            .$excursion['price']
            .$hikers_number
            .$excursion['max_hikers']
            ."<button onclick='showDeleteModal({$excursion['id']})'>Supprimer</button>
        </div>";
}

echo json_encode($response);
