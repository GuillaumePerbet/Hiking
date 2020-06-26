<?php session_start()?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Accueil</title>
</head>
<body class="flex column">
    
    <?php include_once("template/header.php");?>

    <main>
    <?php include_once("template/navbar.html");?>
        
        <section>
            <div class="flex evenly wrap">
                <?php

                if(isset($_SESSION["login"]) && $_SESSION["login"]===true){
                    ?>
        
                    <form class="flex column center justify-center" action="formHandler/logout.php" method="POST">
                        <p>Vous êtes connecté en tant que <?=$_SESSION["user"]?></p>
                        <input class="uk-button-primary" type="submit" value="Déconnexion">
                    </form>
                <?php
                }else{
                    ?>
                    <form id="login-form" class="flex column justify-center" action="">
                        <label for="user">Utilisateur</label>
                        <input type="text" name="user">
                        <div id="userError" class="error"></div>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password">
                        <div id="passwordError" class="error"></div>
                        <input type="submit" value="Connexion">
                    </form>
                <?php
                }
                ?>
            </div>
        </section>
    </main>
    <script src="js/script.js"></script>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>