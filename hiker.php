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
            <div class="flex column">
                <section>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Nom du membre</th>
                                <th scope="col">Excursions</th>
                                <th scope="col">Editer</th>
                            </tr>
                        </thead>

                        <tbody id="hikers-list">

                        </tbody>
                    </table>
                </section>

                <?php
                include_once("formHandler/dbconnect.php");
    
                //fetch array of hiker name and id
                $req = $pdo->query("SELECT id,last_name,first_name FROM hiker");
                $hikers = $req->fetchAll();
                $req -> closeCursor();
    
                //fetch array of excursion name and id
                $req = $pdo->query("SELECT id,name FROM excursion");
                $excursions = $req->fetchAll();
                $req -> closeCursor();
                ?>

                <section>
                    <form id="create-form" class="flex column" action="formHandler/create_hiker.php" method="POST">
                        <label>Nom</label>
                        <input type="text" name="last_name">
                        <div id="lastNameError" class="error"></div>
    
                        <label>Prénom</label>
                        <input type="text" name="first_name">
                        <div id="firstNameError" class="error"></div>
                        
                        <div id="createSuccess" class="success"></div>
                        <input class="uk-button-primary" type="submit" value="Nouveau Membre">
                    </form>
                </section>
    
    
                <section>
                    <form id="registration-form" class="flex column" action="formHandler/registration.php" method="POST">
                        <label>Membre</label>
                        <select id="select-hiker" name="hiker_id">

                        </select>
                        <div id="hikerError" class="error"></div>
    
        
                        <label>Excursion</label>
                        <select name="excursion_id">
                            <?php
                                foreach($excursions as $excursion){
                                    echo "<option value=' {$excursion['id']} '> {$excursion['name']} </option>";
                                }
                            ?>
                        </select>
                        <div id="excursionError" class="error"></div>
    
    
                        <div id="registrationSuccess" class="success"></div>
                        <input class="uk-button-primary" type="submit" value="Inscription">
                    </form>
                </section>
            </div>
        </section>
    </main>

    <script src="js/hiker.js"></script>
    <script src="js/script.js"></script>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>