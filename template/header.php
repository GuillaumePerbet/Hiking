<header class="flex start">
    <div id="user" class="flex column center">
        <div class="flex center justify-center">
            <span uk-icon="icon: user; ratio: 2"></span>
        </div>
        <?php
        if(isset($_SESSION["login"]) && $_SESSION["login"]===true){
            echo "<p class='user-name'>".$_SESSION['user']."</p>";
        }else{
            echo "<p class='user-name not-connected'>Non connecté</p>";
        }
        ?>
    </div>

    <h1>Natural Coach</h1>
</header>