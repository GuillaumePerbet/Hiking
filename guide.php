<?php session_start();?>
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
                <?php
                if (!isset($_SESSION["login"]) || $_SESSION["login"]===false){
                    echo "<p>Veuillez vous connecter pour gérer les guides</p>";
                }else{
                    include_once("dbconnect.php");
                ?>
                    <form class="flex column" action="formHandler/create_guide.php" method="POST">
                        <label>Nom</label>
                        <input type="text" name="last_name" required>
        
                        <label>Prénom</label>
                        <input type="text" name="first_name" required>
        
                        <label>Téléphone</label>
                        <input type="tel" name="phone" required>
        
                        <input class="uk-button-primary" type="submit" value="Nouveau Guide">
                    </form>
                <?php
                }
                ?>
            </div>
        </section>
    </main>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>