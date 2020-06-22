<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once("template/head.html"); ?>
    <title>Créer une excursion</title>
</head>
<body>
    <header>
        <?php include_once("template/navbar.html"); ?>
    </header>
    
    <main>
        <?php include_once("dbconnect.php"); ?>

        <form action="formHandler/create_excursion.php" method="POST">
            <label>Nom de l'excursion
                <input type="text" name="name">
            </label>

            <label>Prix de l'excursion
                <input type="number" name="price">
            </label>

            <label>Nombre de places
                <input type="number" name="max_hikers">
            </label>

            <fieldset>
                <legend>Période</legend>

                <label>Date de début
                    <input type="date" name="departure_date">
                </label>
    
                <label>Date de fin
                    <input type="date" name="arrival_date">
                </label>
            </fieldset>

            <fieldset>
                <legend>Région</legend>

                <label>Point de départ
                    <select name="departure_place">
                        <option value="nord">Nord</option>
                        <?php
                            //récupérer la liste des régions
                        ?>
                    </select>
                </label>
    
                <label>Point d'arrivée
                    <select name="arrival_place">
                        <option value="nord">Nord</option>
                        <?php
                            //récupérer la liste des régions
                        ?>
                    </select>
                </label>
            </fieldset>

            <fieldset>
                <legend>Guides</legend>

                <label>Nom du guide
                    <input type="checkbox" name="guide[]" value="id_guide">
                </label>
                <?php
                    //récupérer les guides (dispo aux dates?)
                ?>
            </fieldset>
            
            <input type="submit" value="Créer l'excursion">
        </form>
    </main>
</body>
</html>