<?php session_start() ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("include/head.php"); ?>
    <link rel="stylesheet" href="sass/forum.css">
    <link rel="stylesheet" href="sass/posts.css">
</head>
<body>

  <!-- HEADER  -->
  <?php include("include/header.php"); ?>

  <!-- START OF PAGE CONTENT  -->
  <main class="background">

    <!-- NAV BAR  -->
    <?php $forumId = $_GET["id"]; 
        $forumQuery = "SELECT forumName FROM forums WHERE forumId = ?";
        $forumResult = $bdd->prepare($forumQuery);
        $forumResult->execute([$forumId]);
        $forum = $forumResult->fetch(PDO::FETCH_ASSOC);
              
        if($forum){ 
             include("include/breadcrumb.php");
            }
        ?>
    <!-- S'adapte sur tout l'écran-->
    <div class="container-fluid row align-items-start">

      <!-- CATEGORIES -->
            <?php if (! empty($_GET['id'])){
                include("include/forums.php");
            }else{ 
                header('Location: index.php');
            } ?>

      <!-- aside -->
      <?php include("include/aside.php"); ?>
    </div>

  </main>
  <!-- END OF PAGE CONTENT -->


  <!-- FOOTER  -->
  <?php include("include/footer.php"); ?>

</body>
</html>
