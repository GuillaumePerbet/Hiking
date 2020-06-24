<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Accueil</title>
</head>
<body>
    <header>
        <?php include_once("template/navbar.html"); ?>
    </header>

    <main>
        <?php if(isset($_SESSION["login"]) && $_SESSION["login"]===true){
            ?>
            <p>Vous êtes connecté en tant que <?=$_SESSION["user"]?></p>

            <form action="formHandler/logout.php" method="POST">
                <input type="submit" value="Déconnexion">
            </form>
        <?php
        }else{
            ?>
            <form action="formHandler/login.php" method="POST">
                <label for="user">Administrateur</label>
                <input type="text" name="user">
                <label for="password">Mot de passe</label>
                <input type="password" name="password">
                <input type="submit" value="Connexion">
            </form>
        <?php
        }
        ?>
    </main>
</body>
</html>