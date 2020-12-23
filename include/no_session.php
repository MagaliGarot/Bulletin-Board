<div class="noPost noSession">
    <h3 class="Become">Sorry</h3>
    <p>You must be logged in to post.</p>

    <div>
    <button type="submit" name="myProfil" class="w-100 btn btn-success">
    <a href='register.php'><strong>Sign up !</strong></a>
    </button>
    <button type="submit" name="myProfil" class="w-100 btn btn-success">
    <a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>"><strong>Previous page</strong></a>
    </button>
    <button type="submit" name="myProfil" class="w-100 btn btn-success">
    <a href='index.php'><strong>Let's go to the boards</strong></a>
    </button>
    </div>

</div>
<?php include "include/forum_rules.php"; ?>