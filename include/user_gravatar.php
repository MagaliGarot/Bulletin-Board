<?php

  $userQuery="SELECT * FROM users WHERE userId =?";
  $userResult=$bdd->prepare($userQuery);
  $userResult->execute([$_SESSION['userId']]);
  $user=$userResult->fetch(PDO::FETCH_ASSOC);

// use this informations to know the email address
$email = $user['userEmail']; 
//img if the address is unknow by Gravatar
$default = "https://cdn1.iconfinder.com/data/icons/sport-avatar-7/64/05-sports-badminton-sport-avatar-player-512.png";
$size = 120; //img size
//creat the URL of the img from Gravatar linked with the email address
$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

?>
<!-- img with the URL created -->
<img class="avatar" src="<?php echo $grav_url; ?>" alt="picture" />
