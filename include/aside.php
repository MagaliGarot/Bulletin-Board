<?php 
/*Récupére les infos utilisateurs*/ 
if (isset($_POST['validateone'])){
   /*----------Récupère le username-----------*/
    /*vide === empty*/ 
    if (!empty($_POST['userName']) AND !empty($_POST['pass'])){
        $userName = htmlspecialchars($_POST['userName']);
        /*htmlspecialchars = permet de sécuriser*/ 
        $pass = hashPwd($_POST['pass']);
        // $pass = sha1($_POST['pass']);
        $check_presence_user = $bdd->prepare('SELECT * FROM users WHERE username = ? AND pwd = ?');
        /* "*" veut dire tous les champs*/ 
        /*Permet de vérifier si l'utilisateur existe dans la base de donnée*/ 
        /* "*" permet de trouver tout ce qui concorde avec la demande*/ 
        $check_presence_user->execute(array($userName, $pass));
        /*permet de vérifier si l'utilisateur existe*/ 

        /*-----------------PERMET A L'UTILISATEUR DE SE CONNECTER-------------------*/
        if ($check_presence_user->rowCount() > 0){
            $infoUser = $check_presence_user->fetch();
            /*Va permettre à l'utilidateur de rester connécté et de récupérer ses infos*/
            $_SESSION['userId'] = $infoUser['userId'];
            $_SESSION['userName'] = $infoUser['username'];
            $succesMessageaside = "Welcome ".$_SESSION['userName'];

          } else{
            $errorMessageaside ="Incorrect username or password";
        }
    } else{
        $errorMessageaside ="Please complete all fields";
    }
}
?>

    <aside class="col-md-3 col-12">
                    <!-----------SEARCH-------------->
                <!-- <form action="" method="POST">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> -->
                  <!-----------Message-------------->
                <?php if (isset($errorMessageaside)) { ?> <p style="color: red;"><?= $errorMessageaside ?></p> <?php } ?>
                <?php if (isset($succesMessageaside)) { ?> <p style="color: green;"><?= $succesMessageaside ?></p> <?php } ?>
                
                <!--- Are you connected? No = login or register. Yes = see your profile page --->
                <?php if (empty($_SESSION['userId'])){
                ?> 
                    <!-----------USERNAME-------------->
                    <h3 class="titlelogin" id="login">Login</h3>
                <form action="index.php" method="POST" name="aside">
                  </br>
                  <div class="w-100 col-auto">
                    <label>Username</label>
                    <div class="input-group mb-2">
                      <input type="text" name="userName" class="form-control" id="inlineFormInputGroup" placeholder="Username" maxlength="16">
                    </div>
                    <!-----------PASSWORD-------------->
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
              
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <button type="submit" name="validateone" class="btn btn-success"><strong>Login</strong></button>
                  </div>
                </form>
                </br>
            <!-----------NEW MEMBER-------------->
            
                <h3 class="Become">Become a member</h3>
                <a href='register.php'> <button type="submit" name="becomeaMembre" class="w-100 btn btn-success">
                <?php echo " <strong>Sign up</strong> !" ?>
                </button></a>
                </br>
            <?php 
            }else{
            ?>
                </br>
                <h3 class="Become">My profile</h3>
                <a href='profile.php'> <button type="submit" name="myProfil" class="w-100 btn btn-success">
                <?php echo "<strong>Complete your profile !</strong> " ?>
                </button></a><br /><br />
                <a href='destroy_session.php'> <button type="submit" name="myProfil" class="w-100 btn btn-success">
                <?php echo "<strong>Log out</strong> " ?>
                </button></a>
            <?php 
            }
            ?>
            

        <form method="post" action="search.php" class="row m-1 mt-5 w-100">
          <input type="text" id="search" name="search" placeholder="Search this website…" class="search p-0 col-10">
          <button type="submit" name="searchButton" class="setting"><img class="settingIcon" src="pictures/icons/search.svg" alt="search"></button>
        </form>
            

      <!-----------LAST POSTS -------------->
         <?php include("aside_lastpost.php"); ?>

        <!-----------LAST ACTIVE USERS -------------->
<h3 class="newmember">New members</h3> 
  <div class="card bg-light col-12 mb-3 mt-3 p-2"> 
    <?php
    $userId = $bdd->prepare('SELECT * FROM users ORDER BY userId DESC LIMIT 3');
    $userId->execute();
    while ($userpost = $userId->fetch(PDO::FETCH_ASSOC)){ ?>
    <div class="container">
      <div class="row p-2">
        <div class="col-3 justify-content-center">
          <?php 
          if($userpost['userPicture'] == 0){ 
            //call gravatar with the email from the poster-user
        $email = $userpost["userEmail"]; 
        $default = "https://cdn1.iconfinder.com/data/icons/sport-avatar-7/64/05-sports-badminton-sport-avatar-player-512.png";
        $size = 50;
        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
        ?>
        <!-- img with the URL created -->
        <img class="newmemberPic rounded-lg" src="<?php echo $grav_url; ?>" alt="picture" />
        <?php } else { 
            $img=base64_encode($userpost['userImage']);?>
            <div class="newmemberPic"><img class="newmemberPic" alt="" class="img-responsive" src="data:image/jpg;charset=utf8mb4_bin;base64,<?php echo $img ?>"/></div>
        <?php }
      ?>
        </div>
        <div class="col-9 d-flex align-items-center">
          <a  class="profile h4 poststitle" href="profile.php?id=<?= $userpost["userId"]; ?>"><?= $userpost['username']; ?></a>  
        </div>
      </div>
    </div>
      <?php
      }
    ?>
  </div>  


