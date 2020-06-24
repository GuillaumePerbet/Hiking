<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Guides</title>
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
    
                    <input type="submit" value="Nouveau Guide">
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