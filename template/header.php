<header class="flex">
    <div id="user" class="flex column center">
        <div class="flex center justify-center">
            <svg width="40" height="40" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="user"><circle fill="none" stroke="#000" stroke-width="1.1" cx="9.9" cy="6.4" r="4.4"></circle><path fill="none" stroke="#000" stroke-width="1.1" d="M1.5,19 C2.3,14.5 5.8,11.2 10,11.2 C14.2,11.2 17.7,14.6 18.5,19.2"></path></svg>
        </div>

        <p id="user-name"><?=htmlspecialchars($_SESSION["user"])?></p>

        <a onclick="disconnect()"><svg fill="#ffeace" width="51.6" height="51.6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="sign-out"><polygon points="13.1 13.4 12.5 12.8 15.28 10 8 10 8 9 15.28 9 12.5 6.2 13.1 5.62 17 9.5"></polygon><polygon points="13 2 3 2 3 17 13 17 13 16 4 16 4 3 13 3"></polygon></svg>Déconnexion</a>
    </div>

    <div id="menu">
        <svg width="51.2" height="51.2" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="menu"><rect x="2" y="4" width="16" height="1"></rect><rect x="2" y="9" width="16" height="1"></rect><rect x="2" y="14" width="16" height="1"></rect></svg>
    </div>

    <h1>HIKING</h1>

    <div id="responsive-deco">
        <a onclick="disconnect()"><svg fill="#ffeace" width="51.6" height="51.6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="sign-out"><polygon points="13.1 13.4 12.5 12.8 15.28 10 8 10 8 9 15.28 9 12.5 6.2 13.1 5.62 17 9.5"></polygon><polygon points="13 2 3 2 3 17 13 17 13 16 4 16 4 3 13 3"></polygon></svg></a>
    </div>
</header>