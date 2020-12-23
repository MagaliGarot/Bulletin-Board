<?php 
if(isset($_POST['buttonPictureSubmit'])){  // Modify Profile Picture button
    $selectedChoice = $_POST['buttonPicture'];
    if($selectedChoice == 'uploaded'){
      $newPictureQuery = "UPDATE users SET userPicture = 1 WHERE userId = ?";
      $newPictureResult = $bdd->prepare($newPictureQuery);
      $newPictureResult->execute([$_SESSION['userId']]);
      header("Location: profile.php");
      exit(0);
    } else if($selectedChoice == 'gravatar'){  // gravatar
      $newPictureQuery = "UPDATE users SET userPicture = 0 WHERE userId = ?";
      $newPictureResult = $bdd->prepare($newPictureQuery);
      $newPictureResult->execute([$_SESSION['userId']]);
      header("Location: profile.php");
      exit(0);
    }
  }
?>