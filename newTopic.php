<?php session_start() ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php"); ?>
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

      <!-- CATEGORIES -->
      <?php include("include/topicCreator.php"); ?>
      <!-- aside -->
      <?php include("include/aside.php"); ?>
    </div>

  </main>
  <!-- END OF PAGE CONTENT -->


  <!-- FOOTER  -->
  <?php include("include/footer.php"); ?>
  <script>
    var simplemde = new SimpleMDE({ element: document.getElementById("topicMessage") });
  </script>

</body>
</html>

