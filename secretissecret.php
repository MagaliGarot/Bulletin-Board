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
    
    <!-- PAGE CONTENT  -->
    <main class="background">
        
    <!-- NAV BAR  -->
    <?php include("include/breadcrumb.php"); ?>
        
        <div class="container-fluid row align-items-start">
            <!-- CATEGORIES -->
            <div class="userContainer col-12 col-md-9">
            <?php 
                include("include/no_access.php");
            ?>
            </div>
            <!-- ASIDE -->
            <?php include("include/aside.php"); ?>
        </div>
    </main>
    <!-- FOOTER  -->
    <?php include("include/footer.php"); ?>
    <script>
        var simplemde = new SimpleMDE({ element: document.getElementById("postMessage") });
    </script>
</body>
</html>

