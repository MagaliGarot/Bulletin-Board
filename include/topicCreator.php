<div class="container-fluid col-12 col-md-9 p-5">

<!-- BOUTON FORUM RULES -->
<?php if (empty($_SESSION['userId'])){
	include("include/no_session.php");
	}else{

		include "include/forum_rules.php";
		
		$forumId = $_GET["id"];
		$topicErrorMessage=" ";

		if(isset($_POST["topicCreation"])){

			$title = htmlspecialchars($_POST['title']);
			$message = htmlspecialchars($_POST['message']);
			?><script>
				document.getElementById("topicTitle").style.borderColor = document.getElementById("topicTitle").value ? silver : red;
				document.getElementById("topicMessage").style.borderColor = document.getElementById("topicMessage").value ? silver : red;
			</script><?php

			if(empty($title)) {
				$topicErrorMessage = "You must enter a title !";
			} elseif(empty($message)) {
				$topicErrorMessage = "You must write a message !";
			} else {
				$newTopicQuery = "INSERT INTO topics (topicTitle, topicForumId, topicAuthorId, isLocked) VALUES (?, ?, ?, ?)";
                $newTopicResult = $bdd->prepare($newTopicQuery);
                $newTopicResult->execute([$title, $forumId, $_SESSION["userId"], 0]);

				$getNewTopicQuery = "SELECT topicId FROM topics WHERE topicTitle = ?";
				$getNewTopicResult = $bdd->prepare($getNewTopicQuery);
				$getNewTopicResult->execute([$title]);
				$newTopic = $getNewTopicResult->fetch(PDO::FETCH_ASSOC);

				$newTopicQuery = "INSERT INTO posts (postUserId, postTopicId, postContent) VALUES (?, ?, ?)";
				$newTopicResult = $bdd->prepare($newTopicQuery);
				$newTopicResult->execute([$_SESSION["userId"], $newTopic["topicId"], $message]);

				unset($title, $message);
				header("Location: forum.php?id=$forumId");
			}

		}
	?>

	<p class="text-danger"><?= $topicErrorMessage?></p>
	<form method="post" class="d-flex flex-column p-3">
		<label for="title" class="p-2 mt-4">Topic title <span class="text-muted">(max. 255 characters)</span></label>
		<input type="text" id="topicTitle" name="title">

		<label for="message" class="p-2 mt-4">Message</label>
		<textarea maxlength="2000" id="topicMessage" name="message"></textarea>
	
		<button type="submit" name="topicCreation" id="topicCreation" class="btn-success rounded-pill w-25 m-3 mt-4 align-self-center">Create new topic</button>
	</form>
	<?php } ?>
</div>

