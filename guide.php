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
    <title>Guides</title>
</head>
<body>

    <?php include_once("template/header.php");?>

    <main>
        <?php include_once("template/navbar.html");?>

        <section>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Editer</th>
                            <th scope="col">Guide</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Excursions</th>
                        </tr>
                    </thead>

                    <tbody id="guides-list">

                    </tbody>
                </table>

                <button onclick="showCreateModal()">Ajouter un guide</button>
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
        
                <label>Téléphone</label>
                <input type="tel" name="phone">
                <div id="phoneError" class="error"></div>

                <input type="submit" value="Nouveau Guide">
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
        
                <label>Téléphone</label>
                <input id="phone-update" type="tel" name="phone">
                <div id="update-phoneError" class="error"></div>

                <input type="submit" value="Modifier">
                <div id="update-idError" class="error"></div>
            </form>
        </div>
    </div>

    <div id="delete-modal" class="hidden modal flex center justify-center">
        <div class="flex column center">
            <p>Etes vous sûr de vouloir supprimer ce guide?</p>
            <div>
                <button id="confirm">oui</button>
                <button id="decline" onclick="hideModal()">non</button>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/guide.js"></script>
</body>
</html>