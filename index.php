<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: excursion.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Hiking - Authentification</title>
</head>
<body id="login" class="flex column center">
    
    <header class="padding0">
        <h1>HIKING</h1>
    </header>

    <main>
        <section class="padding0">
                <form id="login-form" class="flex column justify-center" action="">
                    <label for="user">Utilisateur</label>
                    <input type="text" name="user" placeholder="administrateur">
                    <div id="userError" class="error"></div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" placeholder="root">
                    <div id="passwordError" class="error"></div>
                    <input type="submit" value="Connexion">
                </form>
        </section>
    </main>

    <script src="js/index.js"></script>
</body>
</html>