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
            <div class="flex evenly wrap">
                <form id="create-form" class="flex column" action="">
                    <label>Nom</label>
                    <input type="text" name="last_name" required>
                    <div id="lastNameError" class="error"></div>
    
                    <label>Prénom</label>
                    <input type="text" name="first_name" required>
                    <div id="firstNameError" class="error"></div>
    
                    <label>Téléphone</label>
                    <input type="tel" name="phone" required>
                    <div id="phoneError" class="error"></div>
    
                    <input class="uk-button-primary" type="submit" value="Nouveau Guide">
                </form>
            </div>
        </section>
    </main>

    <script src="js/script.js"></script>
    <script src="js/guide.js"></script>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>