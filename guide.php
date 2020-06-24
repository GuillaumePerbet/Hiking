<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Guides</title>
</head>
<body>
    <header>
        <?php include_once("template/navbar.html"); ?>
    </header>
    
    <main>
        <?php
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

            <input type="submit" value="Nouveau Guide">
        </form>

    </main>
</body>
</html>