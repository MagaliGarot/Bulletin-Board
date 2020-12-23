<div class="collapse" id="deletePost">

	<form method="post" class="d-flex flex-column p-3" action="include/postdelete.php">
	<p><b> Please note, your message will be permanently deleted.</b> </p>
		<textarea maxlength="2000" id="deletePosttext" name="deletePosttext" autocomplete="off">
		<?php echo $lastPostMs; ?>
		</textarea>
		<button type="submit" name="postdeleteButton" id="postdeleteButton" class="btn-success rounded-pill w-25 m-3 mt-4 align-self-center"> <i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
	</form>

</div>
<!-- <script>
  var simplemdeTwo = new SimpleMDE({ element: document.getElementById("editPost") });
</script> -->