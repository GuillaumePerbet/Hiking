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

                <button onclick="showCreateModal()">Ajouter un membre</button>
    
            </div>
        </section>
    </main>

    <div id="create-modal" class="hidden modal flex center justify-center">
        <div class="flex column center">
            <button onclick="hideModal()">retour</button>
            <form id="create-form" class="flex column">
                <label>Nom</label>
                <input type="text" name="last_name">
                <div id="lastNameError" class="error"></div>

                <label>Prénom</label>
                <input type="text" name="first_name">
                <div id="firstNameError" class="error"></div>

                <input type="submit" value="Nouveau Membre">
            </form>
        </div>
    </div>

    <div id="update-modal" class="hidden modal flex center justify-center">
        <div class="flex column center">
            <button onclick="hideModal()">retour</button>
            <form id="update-form" class="flex column">
                <label>Nom</label>
                <input id="last-name-update" type="text" name="last_name">
                <div id="update-lastNameError" class="error"></div>

                <label>Prénom</label>
                <input id="first-name-update" type="text" name="first_name">
                <div id="update-firstNameError" class="error"></div>

                <input type="submit" value="Modifier">
                <div id="update-idError" class="error"></div>
            </form>
        </div>
    </div>

    <div id="delete-modal" class="hidden modal flex center justify-center">
        <div class="flex column center">
            <p>Etes vous sûr de vouloir supprimer ce membre?</p>
            <div>
                <button id="confirm">oui</button>
                <button id="decline" onclick="hideModal()">non</button>
            </div>
        </div>
    </div>

    <div id="registration-modal" class="hidden modal flex center justify-center">
        <div class="flex column center">
            <button onclick="hideModal()">retour</button>
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

                <input type="submit" value="Inscription">
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/hiker.js"></script>
</body>
</html>