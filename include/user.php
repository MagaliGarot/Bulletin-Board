<?php
  $userQuery="SELECT * FROM users WHERE userId =?";
  $userResult=$bdd->prepare($userQuery);
  $userResult->execute([$_SESSION['userId']]);
  $user=$userResult->fetch(PDO::FETCH_ASSOC);
?>

        
        <div class="card m-4">
          <div class="row row-cols-2">
            <div class="col-6 p-5 d-flex align-items-center">
              <form method="post">
                <ul style="list-style-type:none">
                  <?php 
                  include 'profilePictureRadioButton.php';
                  if($user['userPicture'] == 0){ ?>
                  <li>
                    <div class="picGravatar"><?php include 'include/user_gravatar.php' ;?></div>
                  </li>
                  <?php } else { 
                  $img=base64_encode($user['userImage']);?>
                  <li>
                    <div>
                      <img class="avatar" alt="" style="width:100px" class="img-responsive" src="data:image/jpg;charset=utf8mb4_bin;base64,<?php echo $img ?>"/>
                    </div>
                  </li>
                  <?php } ?>
                  <li><input value="gravatar" type="radio" class="m-2 control-input" id="buttonPicture1" name="buttonPicture"> </input>Gravatar   <label class="control-label" for="buttonPicture1"><img src="pictures/info.png" style="width:18px" class="tooltip-profile" data-placement="top" data-toggle="tooltip" data-html="true" title="gravatar" data-content="If you want to use Gravatar for your profile picture, please connect your profile with the same email address used on <a href='https://www.gravatar.com' target='_blank'>gravatar.com</a>"/></label></li>
                  <li><input value="uploaded" type="radio" class="m-2 control-input" id="buttonPicture2" name="buttonPicture"></input><label class="control-label" for="buttonPicture2">Uploaded Picture</label></li>
                  <li><button name="buttonPictureSubmit" id="buttonPictureSubmit" class="btn-success justify-content-center rounded mt-3 d-flex align-self-center p-1 w-50">Submit</button></li>
                </ul>
              </form>
            </div>
            <div class="col-6 card-body">
              <p class="mb-3">Name : <?= $user['username'] ?></p>
              <p class="mb-3">Email : <?= $user['userEmail'] ?></p>
              <div class="mb-3">Signature : 
                <div class="col-8">
                  <?= Michelf\MarkdownExtra::defaultTransform($user["userSignature"]); ?>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        
        
      