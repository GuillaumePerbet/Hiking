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
            <?php
            if (!isset($_SESSION["login"]) || $_SESSION["login"]===false){
                echo "<p>Vous n'êtes pas connecté</p>";
            }else{
                include_once("dbconnect.php");
            ?>
                <form action="formHandler/create_guide.php" method="POST">
                    <label>Nom
                        <input type="text" name="last_name" required>
                    </label>
    
                    <label>Prénom
                        <input type="text" name="first_name" required>
                    </label>
    
                    <label>Phone
                        <input type="tel" name="phone" required>
                    </label>
    
                    <input class="uk-button-primary" type="submit" value="Nouveau Guide">
                </form>
            <?php
            }
            ?>
        </section>
    </main>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>