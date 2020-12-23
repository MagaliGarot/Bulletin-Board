<?php 
$email = "mail@mail.mail"; // a non-existent address to have the default avatar
    $default = "https://cdn1.iconfinder.com/data/icons/sport-avatar-7/64/05-sports-badminton-sport-avatar-player-512.png";
    $size = 120;
    $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

?>
<img class="avatar" src="<?php echo $grav_url; ?>" alt="picture" />