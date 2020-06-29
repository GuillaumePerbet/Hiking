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
    <title>Identification</title>
</head>
<body id="login" class="flex column">
    
    <header>
        <h1><span>Natural</span> Coach</h1>
    </header>

    <main class="center">
        <section>
                <form id="login-form" class="column justify-center" action="">
                    <label for="user">Utilisateur</label>
                    <input type="text" name="user">
                    <div id="userError" class="error"></div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password">
                    <div id="passwordError" class="error"></div>
                    <input type="submit" value="Connexion">
                </form>
        </section>
    </main>

    <script src="js/index.js"></script>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>