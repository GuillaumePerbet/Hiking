<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Randonneurs</title>
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
    
    
                <form action="formHandler/registration.php" method="POST">
                    <label>Randonneur
                        <select name="hiker_id" required>
                            <?php
                                foreach($hikers as $hiker){
                                    echo "<option value=' {$hiker['id']} '> {$hiker['last_name']} {$hiker['first_name']} </option>";
                                }
                            ?>
                        </select>
                    </label>
    
                    <label>Excursion
                        <select name="excursion_id" required>
                            <?php
                                foreach($excursions as $excursion){
                                    echo "<option value=' {$excursion['id']} '> {$excursion['name']} </option>";
                                }
                            ?>
                        </select>
                    </label>
    
                    <input type="submit" value="Inscrire">
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