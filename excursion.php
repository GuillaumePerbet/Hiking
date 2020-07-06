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
<body>

    <?php include_once("template/header.php");?>

    <main>
        <?php include_once("template/navbar.html");?>

        <section>
            <button class="large-btn" onclick="showCreateModal()">Créer une excursion</button>

            <div id="excursions" class="flex wrap evenly">

            </div>
        </section>
    </main>

    <div id="create-modal" class="hidden modal flex center justify-center">
        <div class="flex column center">
            <button class="remove" onclick="hideModal()"></button>
            <form id="create-form" class="flex column center">
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
                                <input type='checkbox' name='guide_ids[]' value='<?=$guide['id']?>'>
                                <?=$guide['first_name']?> <?=$guide['last_name']?>
                            </label>
                        <?php
                        }
                        ?>
                        <div id="guidesError" class="error"></div>
                    </fieldset>
                </div>

                <input type="submit" value="Créer l'excursion">
            </form>
        </div>
    </div>

    <div id="update-modal" class="hidden modal flex center justify-center">
        <div class="flex column center">
            <button class="remove" onclick="hideModal()"></button>
            <form id="update-form" class="flex column center">
                <div class="flex wrap evenly start">
                    <fieldset class="flex column">
                        <legend>Excursion</legend>

                        <label>Nom de l'excursion</label>
                        <input id="name-update" type="text" name="name">
                        <div id="update-nameError" class="error"></div>
        
                        <label class="flex between">Prix de l'excursion
                        <input id="price-update" type="number" name="price">
                        </label>
                        <div id="update-priceError" class="error"></div>
        
                        <label class="flex between">Nombre de places
                        <input id="maxHikers-update" type="number" name="max_hikers">
                        </label>
                        <div id="update-maxHikersError" class="error"></div>
                    </fieldset>
    
                    <fieldset class="flex column">
                        <legend>Période</legend>
    
                        <label>Date de début</label>
                        <input id="departureDate-update" type="date" name="departure_date">
            
                        <label>Date de fin</label>
                        <input id="arrivalDate-update" type="date" name="arrival_date">

                        <div id="update-dateError" class="error"></div>
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
                        <select id="departurePlace-update" name="departure_place_id">
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
                        <select id="arrivalPlace-update" name="arrival_place_id">
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
                        <div id="update-placeError" class="error"></div>
                    </fieldset>
    
                    <fieldset id="guides-update" class="flex column">
                        <legend>Guides</legend>
    
                        <?php
                        //fetch array of guide name and id
                        $req = $pdo->query("SELECT id,last_name,first_name FROM guide");
                        $guides = $req->fetchAll();
                        $req -> closeCursor();
                        foreach($guides as $guide){
                        ?>
                            <label>
                                <input type='checkbox' name='guide_ids[]' value='<?=$guide['id']?>'>
                                <?=$guide['first_name']?> <?=$guide['last_name']?>
                            </label>
                        <?php
                        }
                        ?>
                        <div id="update-guidesError" class="error"></div>
                    </fieldset>
                </div>

                <input type="submit" value="Modifier">
                <div id="update-idError" class="error btn-error"></div>
            </form>
        </div>
    </div>

    <div id="delete-modal" class="hidden modal flex center justify-center">
        <div class="flex column center">
            <p>Êtes vous sûr de vouloir supprimer cette excursion?</p>
            <div>
                <button id="confirm"></button>
                <button id="decline" onclick="hideModal()"></button>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/excursion.js"></script>
</body>
</html>