<?php session_start() ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php");?>
<link rel="stylesheet" href="sass/style_user.css">
<link rel="stylesheet" href="sass/posts.css">
</head>
<body>

  <!-- HEADER  -->
  <?php include("include/header.php"); ?>
 
  <!-- START OF PAGE CONTENT  -->
  <main class="background">

    <!-- NAV BAR  -->
    <?php include("include/breadcrumb.php"); ?>
    <!-- S'adapte sur tout l'écran-->
    <div class="container-fluid row align-items-start">
   

      <!-- USER PROFIL -->
      <div class="container col-lg-9 col-12 col-md-8">
          <?php       
                if (! empty($_GET['id'])){
                    include("include/user_profile.php");
                }elseif (! empty($_SESSION['userId'])){
                    include("include/user.php");
                    include("include/profile_editor.php");
                }else{ 
                  include("include/no_user.php");
                }
                if ((isset($_POST['validatetwo'])) || (isset($_POST['userSubmit'])) || (isset($_POST['usernameSubmit'])) || (isset($_POST['upload']))){
                  header("Location: profile.php");
                }
          ?>
      </div>

      <!-- aside -->
      <?php include("include/aside.php"); ?>
    </div>

  </main>
  <!-- END OF PAGE CONTENT -->


  <!-- FOOTER  -->
  <?php include("include/footer.php"); ?>
  <script type="text/javascript" src="script/profile.js"></script>
  <script>
    const simplemde = new SimpleMDE({ element: document.getElementById("userSignature") });
</script>
</body>
</html>
