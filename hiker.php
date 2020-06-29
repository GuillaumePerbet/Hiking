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
    <title>Randonneurs</title>
</head>
<body class="flex column">

    <?php include_once("template/header.php");?>

    <main>
        <?php include_once("template/navbar.html");?>

        <section>
            <div class="flex evenly wrap">
                <?php
                include_once("dbconnect.php");
    
                //fetch array of hiker name and id
                $req = $pdo->query("SELECT * FROM hiker");
                $hikers = $req->fetchAll();
                $req -> closeCursor();
    
                //fetch array of excursion name and id
                $req = $pdo->query("SELECT id,name FROM excursion");
                $excursions = $req->fetchAll();
                $req -> closeCursor();
                ?>

                <form id="create-form" class="flex column" action="formHandler/create_hiker.php" method="POST">
                    <label>Nom</label>
                    <input type="text" name="last_name" required>
                    <div id="lastNameError" class="error"></div>

                    <label>Prénom</label>
                    <input type="text" name="first_name" required>
                    <div id="firstNameError" class="error"></div>
                    
                    <div id="createSuccess" class="success"></div>
                    <input class="uk-button-primary" type="submit" value="Nouveau Membre">
                </form>
    
    
                <form class="flex column" action="formHandler/registration.php" method="POST">
                    <label>Membre</label>
                    <select name="hiker_id" required>
                        <?php
                            foreach($hikers as $hiker){
                                echo "<option value=' {$hiker['id']} '> {$hiker['last_name']} {$hiker['first_name']} </option>";
                            }
                        ?>
                    </select>
    
                    <label>Excursion</label>
                    <select name="excursion_id" required>
                        <?php
                            foreach($excursions as $excursion){
                                echo "<option value=' {$excursion['id']} '> {$excursion['name']} </option>";
                            }
                        ?>
                    </select>

                    <div id="registrationSuccess" class="success"></div>
                    <input class="uk-button-primary" type="submit" value="Inscription">
                </form>
            </div>
        </section>
    </main>

    <script src="js/hiker.js"></script>
    <script src="js/script.js"></script>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>