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

                <section>
                    <form id="create-form" class="flex column">
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
                    <form id="registration-form" class="flex column">
                        <label>Membre</label>
                        <select id="select-hiker" name="hiker_id"></select>
                        <div id="hikerError" class="error"></div>
    
        
                        <label>Excursion</label>
                        <select name="excursion_id">
                            <?php
                            //fetch array of excursion name and id
                            include_once("formHandler/dbconnect.php");
                            $req = $pdo->query("SELECT id,name FROM excursion");
                            $excursions = $req->fetchAll();
                            $req -> closeCursor();
                            foreach($excursions as $excursion){
                            ?>
                                <option value="<?=$excursion['id']?>">
                                    <?= $excursion['name']?>
                                </option>
                            <?php
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

    <div id="modal" class="flex center justify-center hidden">
        <div class="flex column center">
            <p>Etes vous sûr de vouloir supprimer ce membre?</p>
            <div>
                <button id="confirm">oui</button>
                <button id="decline" onclick="decline()">non</button>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/hiker.js"></script>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>