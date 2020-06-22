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
        <form action="" method="POST">
            <label for="user">Administrateur</label>
            <input type="text" name="user">
            <label for="password">Mot de passe</label>
            <input type="password" name="password">
            <input type="submit" value="Connexion">
        </form>
    </main>
</body>
</html>