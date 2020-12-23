<div class="collapse" id="newEditorPost">

	<p class="text-danger"><?= $postErrorMessage?></p>

	<form method="post" class="d-flex flex-column p-3" action="include/postEditValidate.php">
		<textarea maxlength="2000" id="editPost" name="editPost" placeholder="Your message…" autocomplete="off">
		<?php echo $lastPostMs; ?>
		</textarea>
		<button type="submit" name="postEditButton" id="postEditButton" class="btn-success rounded-pill w-25 m-3 mt-4 align-self-center">Post Edit</button>
	</form>

</div>
<!-- <script>
  var simplemdeTwo = new SimpleMDE({ element: document.getElementById("editPost") });
</script> -->