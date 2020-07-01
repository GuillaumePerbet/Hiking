<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: index.php");
}
include_once("formHandler/dbconnect.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Créer une excursion</title>
</head>
<body class="flex column">

    <?php include_once("template/header.php");?>

    <main>
        <?php include_once("template/navbar.html");?>

        <section id="excursion">
            <div class="flex column">
                <section id="excursions-list">
                </section>
                
                <section>
                    <form id="create-form" class="flex column center" action="formHandler/create_excursion.php" method="POST">
                        <div class="flex wrap evenly start">
                            <fieldset class="flex column">
                                <legend>Excursion</legend>
        
                                <label>Nom de l'excursion</label>
                                <input type="text" name="name">
                                <div id="nameError" class="error"></div>
                
                                <label class="flex between">Prix de l'excursion
                                <input type="number" name="price">
                                </label>
                                <div id="priceError" class="error"></div>
                
                                <label class="flex between">Nombre de places
                                <input type="number" name="max_hikers">
                                </label>
                                <div id="maxHikersError" class="error"></div>
                            </fieldset>
            
                            <fieldset class="flex column">
                                <legend>Période</legend>
            
                                <label>Date de début</label>
                                <input type="date" name="departure_date">
                    
                                <label>Date de fin</label>
                                <input type="date" name="arrival_date">
    
                                <div id="dateError" class="error"></div>
                            </fieldset>
            
                            <fieldset class="flex column">
                                <legend>Région</legend>
    
                                <?php
                                //fetch array of place name and id
                                $req = $pdo->query("SELECT id,name FROM place");
                                $places = $req->fetchAll();
                                $req -> closeCursor();
                                ?>
            
                                <label>Point de départ</label>
                                <select name="departure_place_id">
                                    <?php
                                    foreach($places as $place){
                                    ?>
                                        <option value="<?=$place['id']?>">
                                            <?=$place['name']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                    
                                <label>Point d'arrivée</label>
                                <select name="arrival_place_id">
                                    <?php
                                    foreach($places as $place){
                                    ?>
                                        <option value="<?=$place['id']?>">
                                            <?=$place['name']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div id="placeError" class="error"></div>
                            </fieldset>
            
                            <fieldset class="flex column">
                                <legend>Guides</legend>
            
                                <?php
                                //fetch array of guide name and id
                                $req = $pdo->query("SELECT id,last_name,first_name FROM guide");
                                $guides = $req->fetchAll();
                                $req -> closeCursor();
                                foreach($guides as $guide){
                                ?>
                                    <label>
                                        <input type='checkbox' name='guide_ids[]' value=' <?=$guide['id']?> '>
                                        <?=$guide['first_name']?> <?=$guide['last_name']?>
                                    </label>
                                <?php
                                }
                                ?>
                                <div id="guidesError" class="error"></div>
                            </fieldset>
                        </div>
                        
                        <div id="createSuccess" class="success"></div>
                        <input class="uk-button-primary" type="submit" value="Créer l'excursion">
                    </form>
                </section>
            </div>
        </section>
    </main>

    <script src="js/excursion.js"></script>
    <script src="js/script.js"></script>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>