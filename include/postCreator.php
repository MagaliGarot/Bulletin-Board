<div class="collapse" id="newTopicEditor">

	<?php 
		$_SESSION["topicId"] = $_GET["id"];
		$postErrorMessage=" ";
	?>

	<p class="text-danger"><?= $postErrorMessage?></p>
	<form method="post" action="include/postValidate.php" class="d-flex flex-column p-3">
		<textarea maxlength="2000" id="postMessage" name="message" placeholder="Your message…" autocomplete="off"></textarea>
	
		<button type="submit" name="postCreation" id="postCreation" class="btn-success rounded-pill w-25 m-3 mt-4 align-self-center">Create new post</button>
	</form>

</div>


