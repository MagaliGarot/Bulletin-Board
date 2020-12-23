<?php
      $userId = $_GET["id"];
      $userQuery="SELECT * FROM users WHERE userId =?";
      $userResult=$bdd->prepare($userQuery);
      $userResult->execute([$_GET['id']]);
      $user=$userResult->fetch(PDO::FETCH_ASSOC);

      if(!empty($_SESSION['userId']) AND $userId == $_SESSION['userId']){
        include("include/user.php");
      }elseif($user){
?>
        <div class="user-container">
          <div class="name">Name :</div>
          <div class="signature2">Signature :</div>
          <div class="username"><?php if($user){echo $user["username"];} ?></div>
          <div class="signatureTxt"><?php if($user){echo $user['userSignature'];}?></div>
          <?php if($user['userPicture'] == 0){ 
            $email = $user["userEmail"]; 
            $default = "https://cdn1.iconfinder.com/data/icons/sport-avatar-7/64/05-sports-badminton-sport-avatar-player-512.png";
            $size = 50;
            $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size; ?>
            <img class="avatar rounded-lg" src="<?php echo $grav_url; ?>" alt="picture" />
          <?php } else { 
            $img=base64_encode($user['userImage']);?>
            <div><img class="avatar" alt="" style="width:100px" class="img-responsive" src="data:image/jpg;charset=utf8mb4_bin;base64,<?php echo $img ?>"/></div>
          <?php } ?>        
        </div>
        
<?php

      }else{
        include("include/no_user.php");
      }
?>
