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
        "SELECT g.first_name, g.last_name, g.id
        FROM excursion AS e
        INNER JOIN accompany AS a ON a.excursion_id=e.id
        INNER JOIN guide AS g ON g.id=a.guide_id
        WHERE e.id=?"
    );
    $req->execute([$excursion["id"]]);
    $guides = $req->fetchAll();
    $req -> closeCursor();
    $guideNames = $guides[0]["last_name"];
    $excursion["guides"] = [$guides[0]["id"]];
    foreach($guides as $i=>$guide){
        if ($i!=0){
            $guideNames .= ", ".$guide["last_name"];
            array_push($excursion["guides"],$guide["id"]);
        }
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
        "<section>
            <header>
                <h2>".htmlentities($excursion['name'])."</h2>
                <div>
                    <p class='price'>".$excursion['price']."€</p>
                    <p>Inscriptions : ".$hikers_number."/".$excursion['max_hikers']."</p>
                </div>
            </header>
            <div>
                <p>Départ le ".$excursion['departure_date']." de la région ".htmlentities($departure_place)."</p>
                <p>Arrivée le ".$excursion['arrival_date']." à la région ".htmlentities($arrival_place)."</p>
                <div class='flex between'>
                    <p>Guides : ".htmlentities($guideNames)."</p>
                    <div>
                        <button class='medium-btn trash' onclick='showDeleteModal({$excursion['id']})'></button>
                        <button class='medium-btn edit' onclick='showUpdateModal(".json_encode($excursion).")'></button>
                    </div>
                </div>
            </div>
        </section>";
}

echo json_encode($response);
