<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Créer une excursion</title>
</head>
<body>
    <header>
        <?php include_once("template/navbar.html"); ?>
    </header>
    
    <main>
        <?php
        if (!isset($_SESSION["login"]) || $_SESSION["login"]===false){
            echo "<p>Vous n'êtes pas connecté</p>";
        }else{
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
            <form action="formHandler/create_excursion.php" method="POST">
                <label>Nom de l'excursion
                    <input type="text" name="name" required>
                </label>

                <label>Prix de l'excursion
                    <input type="number" name="price" required>
                </label>

                <label>Nombre de places
                    <input type="number" name="max_hikers" required>
                </label>

                <fieldset>
                    <legend>Période</legend>

                    <label>Date de début
                        <input type="date" name="departure_date" required>
                    </label>
        
                    <label>Date de fin
                        <input type="date" name="arrival_date" required>
                    </label>
                </fieldset>

                <fieldset>
                    <legend>Région</legend>

                    <label>Point de départ
                        <select name="departure_place_id" required>
                            <?php
                                foreach($places as $place){
                                    echo "<option value=' {$place['id']} '> {$place['name']} </option>";
                                }
                            ?>
                        </select>
                    </label>
        
                    <label>Point d'arrivée
                        <select name="arrival_place_id" required>
                            <?php
                                foreach($places as $place){
                                    echo "<option value=' {$place['id']} '> {$place['name']} </option>";
                                }
                            ?>
                        </select>
                    </label>
                </fieldset>

                <fieldset>
                    <legend>Guides</legend>

                    <?php
                    foreach($guides as $guide){
                        echo "<label> {$guide['first_name']} {$guide['last_name']}
                        <input type='checkbox' name='guide_ids[]' value=' {$guide['id']} '>";
                    }
                    ?>
                    </label>
                </fieldset>
                
                <input type="submit" value="Créer l'excursion">
            </form>
        <?php    
        }
        ?>
    </main>
</body>
</html>