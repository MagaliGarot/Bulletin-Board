<?php session_start() ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php"); ?>
<link rel="stylesheet" href="sass/style_user.css">
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
   

      <!-- USER MODIFIER SIGNATURE -->
      <div class="col-12 col-md-9">
          <?php include "include/modifSignatureCreator.php"; ?>
      </div>

      <!-- aside -->
      <?php include("include/aside.php"); ?>
    </div>

  </main>
  <!-- END OF PAGE CONTENT -->


  <!-- FOOTER  -->
  <?php include("include/footer.php"); ?>
  <script>
    const simplemde = new SimpleMDE({ element: document.getElementById("userSignature") });
</script>
</body>
</html>
