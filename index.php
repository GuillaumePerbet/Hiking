<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Accueil</title>
</head>
<body>
    <header>
        <div id="user">
            <div><span uk-icon="icon: user; ratio: 2"></span></div>
            <?php
            if(isset($_SESSION["login"]) && $_SESSION["login"]===true){
                echo "<p>".$_SESSION['user']."</p>";
            }else{
                echo "<p>Non connecté</p>";
            }
            ?>
        </div>
    </header>

    <main>
        <?php include_once("template/navbar.html");?>
        
        <section>
            <?php
            if(isset($_SESSION["login"]) && $_SESSION["login"]===true){
                ?>
                <p>Vous êtes connecté en tant que <?=$_SESSION["user"]?></p>
    
                <form action="formHandler/logout.php" method="POST">
                    <input class="uk-button-primary" type="submit" value="Déconnexion">
                </form>
            <?php
            }else{
                ?>
                <form action="formHandler/login.php" method="POST">
                    <label for="user">Utilisateur</label>
                    <input type="text" name="user">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password">
                    <input class="uk-button-primary" type="submit" value="Connexion">
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