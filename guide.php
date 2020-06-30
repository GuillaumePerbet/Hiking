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
                                <th scope="col">Nom du guide</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Excursions</th>
                                <th scope="col">Editer</th>
                            </tr>
                        </thead>

                        <tbody id="guides-list">

                        </tbody>
                    </table>
                </section>

                <section>
                    <form id="create-form" class="flex column" action="">
                        <label>Nom</label>
                        <input type="text" name="last_name">
                        <div id="lastNameError" class="error"></div>
        
                        <label>Prénom</label>
                        <input type="text" name="first_name">
                        <div id="firstNameError" class="error"></div>
        
                        <label>Téléphone</label>
                        <input type="tel" name="phone">
                        <div id="phoneError" class="error"></div>
        
                        <div id="createSuccess" class="success"></div>
                        <input class="uk-button-primary" type="submit" value="Nouveau Guide">
                    </form>
                </section>
            </div>
        </section>
    </main>

    <script src="js/script.js"></script>
    <script src="js/guide.js"></script>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>