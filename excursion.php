<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: index.php");
}
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
            <div class="flex evenly wrap">
                <?php
                include_once("dbconnect.php");
                //fetch array of place name and id
                $req = $pdo->query("SELECT * FROM place");
                $places = $req->fetchAll();
                $req -> closeCursor();
    
                //fetch array of guide name and id
                $req = $pdo->query("SELECT id,last_name,first_name FROM guide");
                $guides = $req->fetchAll();
                $req -> closeCursor();
                ?>
                <form class="flex column center" action="formHandler/create_excursion.php" method="POST">
                    <div class="flex wrap evenly start">
                        <fieldset class="flex column">
                            <legend>Excursion</legend>
    
                            <label>Nom de l'excursion</label>
                            <input type="text" name="name">
            
                            <label class="flex between">Prix de l'excursion
                            <input type="number" name="price">
                            </label>
            
                            <label class="flex between">Nombre de places
                            <input type="number" name="max_hikers">
                            </label>
                        </fieldset>
        
                        <fieldset class="flex column">
                            <legend>Période</legend>
        
                            <label>Date de début</label>
                            <input type="date" name="departure_date">
                
                            <label>Date de fin</label>
                            <input type="date" name="arrival_date">
                        </fieldset>
        
                        <fieldset class="flex column">
                            <legend>Région</legend>
        
                            <label>Point de départ</label>
                            <select name="departure_place_id">
                                <?php
                                    foreach($places as $place){
                                        echo "<option value=' {$place['id']} '> {$place['name']} </option>";
                                    }
                                ?>
                            </select>
                
                            <label>Point d'arrivée</label>
                            <select name="arrival_place_id">
                                <?php
                                    foreach($places as $place){
                                        echo "<option value=' {$place['id']} '> {$place['name']} </option>";
                                    }
                                ?>
                            </select>
                        </fieldset>
        
                        <fieldset class="flex column">
                            <legend>Guides</legend>
        
                            <?php
                            foreach($guides as $guide){
                            ?>
                                <label>
                                    <input type='checkbox' name='guide_ids[]' value=' <?=$guide['id']?> '>
                                    <?=$guide['first_name']?> <?=$guide['last_name']?>
                                </label>
                            <?php
                            }
                            ?>
                            
                        </fieldset>
                    </div>
                    
                    <input class="uk-button-primary" type="submit" value="Créer l'excursion">
                </form>
            </div>
        </section>
    </main>
    <script src="js/script.js"></script>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>