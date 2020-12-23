<?php

      $userId = $_GET['id'];
      $userQuery="SELECT * FROM users WHERE userId =?";
      $userResult=$bdd->prepare($userQuery);
      $userResult->execute([$_GET['id']]);
      $user=$userResult->fetch(PDO::FETCH_ASSOC);
  
      $email = $user['userEmail']; 
      $default = "https://cdn1.iconfinder.com/data/icons/sport-avatar-7/64/05-sports-badminton-sport-avatar-player-512.png";
      $size = 120;
      $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
  
?>
<!-- img with the URL created -->
<img class="avatar" src="<?php echo $grav_url; ?>" alt="picture" />
