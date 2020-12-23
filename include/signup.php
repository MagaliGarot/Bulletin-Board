<div class="container-fluid col-12 col-md-9 p-5">

<?php
include 'bdd.php';
if(isset($_POST['validatetwo'])){
    //htmlspecialchars permet de sécuriser le forum des scripts
    $username = htmlspecialchars($_POST['username']);
    $userEmail = htmlspecialchars($_POST['userEmail']);
    //password_hash permet de sécuriser les mots de passe
    $pwd = hashPwd($_POST['pwd']);
    // $pwd = sha1($_POST['pwd']);
    //date
    date_default_timezone_set('Europe/Paris');
    $date = date('d/m/Y à H:i:s');

    //Email unique === récupère les entrées de la table users
    $queryemail = $bdd->prepare("SELECT userEmail FROM users WHERE userEmail = ?");
    $queryemail->execute([$userEmail]); 
    //Username unique === récupère les entrées de la table users
    $queryusername = $bdd->prepare("SELECT username FROM users WHERE username = ?");
    $queryusername->execute([$username]); 

    //empty =vide
    if (empty($_POST["username"])){
        $errorMessage ="Empty Username";
    } elseif (empty($_POST["userEmail"])){
        $errorMessage ="Empty mail";
    } elseif (empty($_POST["pwd"])){
        $errorMessage ="Empty Password";
    } elseif ($_POST['pwd'] != $_POST['pwd-confirm']) {
        $errorMessage ="Password not identical";
    }  elseif(strlen($username) >= 16){
        $errorMessage ="Username too long, (maximum 16 characters).";
    } elseif($queryemail->fetch()) {
        //recupère la première ligne du tableau $queryuserEmail
        $errorMessage ="Email already existing on our forum !";
    } elseif($queryusername->fetch()) {
        //recupère la première ligne du tableau $queryusername
        $errorMessage ="Username already taken !";
    } else {
            //insérer un membre
            $insert_user = $bdd->prepare('INSERT INTO users(username, userEmail, pwd)VALUES(?, ?, ?)');
            /*USERS = nom da la table sur phpMyAdmin*/
            $insert_user->execute(array($username, $userEmail, $pwd));
            /*-----SESSIONS----- */
            $check_session = $bdd->prepare('SELECT * FROM users WHERE username = ? AND userEmail = ? AND pwd = ?');
            /*Permet de récupérer les infos de l'utilisateur -> fetch*/
            $check_session->execute(array($username, $userEmail, $pwd));
            $info_user = $check_session->fetch();
            /*Va permettre à l'utilisateur de rester connécté et de récupérer ses infos*/
            $_SESSION['pwd'] = $info_user['pwd'];
            $_SESSION['userId'] = $info_user['userId'];
            $_SESSION['userEmail'] = $info_user['userEmail'];
            $_SESSION['username'] = $info_user['username'];
            $succesMessage = "You are registered. Welcome to the forum, don't forget to introduce yourself!"; 
        //Fin de l'espace utilisateur    
        //fin du premier if
    
    } 
}
?>

        <div id="login">
            <h3 class="text-center pt-5">Form</h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="register.php" name="signup" method="post">
                                <h3 class="text-center text-info">Become a member</h3>
                                <?php if (isset($errorMessage)) { ?> <p style="color: red;"><?= $errorMessage ?></p> <?php } ?>
                                <?php if (isset($succesMessage)) { ?> <p style="color: green;"><?= $succesMessage ?></p> <?php } ?>
                                <!--USERNAME*-->
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input type="text" name="username" id="username" class="form-control" maxlength="16">
                                </div>
                                <!--EMAIL*-->
                                <div class="form-group">
                                    <label for="email" class="text-info">Email:</label><br>
                                    <input type="text" name="userEmail" id="email" class="form-control">
                                </div>
                                <!--PASSWORD*-->
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="password" name="pwd" id="pwd" class="form-control" maxlength="40">
                                </div>
                                <!--PASSWORD CONFIRM*-->
                                <div class="form-group">
                                    <label for="password" class="text-info">Confirm Password:</label><br>
                                    <input type="password" name="pwd-confirm" id="pwd-confirm" class="form-control" maxlength="40">
                                </div>
                                <div class="form-group">
                                    <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label>
                                    <br>
                                    <!--BUTTON CONFIRM*-->
                                    <input type="submit" name="validatetwo" class="btn btn-info btn-md" value="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
