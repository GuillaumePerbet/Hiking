<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Randonneurs</title>
</head>
<body>
    <header>
        <?php include_once("template/navbar.html"); ?>
    </header>
    
    <main>
        <?php
            include_once("dbconnect.php");

            //fetch array of hiker name and id
            $req = $pdo->query("SELECT * FROM hiker");
            $hikers = $req->fetchAll();
            $req -> closeCursor();

            //fetch array of excursion name and id
            $req = $pdo->query("SELECT id,name FROM excursion");
            $excursions = $req->fetchAll();
            $req -> closeCursor();
        ?>

        <form action="formHandler/create_hiker.php" method="POST">
            <label>Nom
                <input type="text" name="last_name" required>
            </label>

            <label>Prénom
                <input type="text" name="first_name" required>
            </label>

            <input type="submit" value="Nouveau Membre">
        </form>
    </main>
</body>
</html>