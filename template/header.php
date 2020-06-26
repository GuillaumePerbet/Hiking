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

    <div id="menu">
        <span uk-icon="icon: menu; ratio: 2.56"></span>
    </div>

    <h1><span>Natural</span> Coach</h1>
</header>