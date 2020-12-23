<?php 
if (isset($_POST['upload'])) {
    $name= $_FILES['file']['name'];
    $size = $_FILES['file']['size'];

    $tmp_name= $_FILES['file']['tmp_name'];

    $position= strpos($name, ".");

    $fileextension= substr($name, $position + 1);

    $fileextension= strtolower($fileextension);
    if (empty($name)){
        echo "Please choose a file";
    } else if (!empty($name)){
        if (($fileextension !== "jpg") && ($fileextension !== "jpeg") && ($fileextension !== "gif") && ($fileextension !== "png") && ($fileextension !== "bmp")){
            echo "The file extension must be .jpg, .jpeg, .png, .gif or .bmp in order to be uploaded<br>If you have some '.' into the filename, it will not working";
        }else if ($size > 2000000){
            echo "Your picture is to loud, please select a picture with max 2Mb";
        } else {
            
            $imageQuery = "UPDATE users SET userImage = ? WHERE userId = ?";
            $imageResult = $bdd->prepare($imageQuery);
            $imageResult->execute([file_get_contents($tmp_name) , $_SESSION['userId']]);

            echo 'Uploaded ';
    
            $newPictureQuery = "UPDATE users SET userPicture = 1 WHERE userId = ?";
            $newPictureResult = $bdd->prepare($newPictureQuery);
            $newPictureResult->execute([$_SESSION['userId']]);

        
            
        }
    }
} 
?>

