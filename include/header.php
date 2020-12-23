<div class="image">

    <!-- TEXT MAIN IMAGE -->
    <h1 class="Title"> BADMINTON CLUB BAIN DE BRETAGNE </h1>
    <div class="logcontainer">
        <?php if (empty($_SESSION['userId']))
        {
        ?>
        <p class="login" id="haut"><strong>
            <a href="register.php" class="login">
                <img class="settingIcon-white" src="pictures/icons/account-circle-line.svg" alt="">
                Register
            </a> 
            <a href="#login" class="login">
                <img class="settingIcon-white" src="pictures/icons/login-circle-line.svg" alt="">
                Login
            </a> 
        </strong></p>
        <?php 
        }else{
            $usernameQuery = "SELECT username FROM users WHERE userId = ?";
            $usernameResult = $bdd->prepare($usernameQuery);
            $usernameResult->execute([$_SESSION['userId']]);
            $username = $usernameResult->fetch(PDO::FETCH_ASSOC);
        ?>
        <p class="login"  id="haut"><strong>
            Welcome <?= $username["username"]; ?>
            <a href="profile.php" class="login ml-1">
                <img class="settingIcon-white" src="pictures/icons/account-circle-line.svg" alt="">
                My profile
            </a>
            <a href="destroy_session.php" class="login">
                <img class="settingIcon-white" src="pictures/icons/logout-circle-line.svg" alt="">
                Log out
            </a>
        </strong></p>
        <?php 
        }
        ?>
    </div>
    <div><a id="cRetour" class="cInvisible" href="#haut"></a></div>
</div>
