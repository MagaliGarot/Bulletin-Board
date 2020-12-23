<?php
	session_start();
	include("bdd.php");
	$newEditPost = htmlspecialchars($_POST["editPost"]);
	//ENT_QUOTES
	//Variable déclarée plus haut ---> $postRow["postDate"]; $lastPostId = $postRow['postId']; $lastPostMs = $postRow['postContent'];
	//postEditCreation bouton du textaera sur editPost
	$lastPostId = $_SESSION["lastPostId"];
	unset($_SESSION["lastPostId"]);
	$topicId = $_SESSION["topicId"];
	unset($_SESSION["topicId"]);

	if(empty($newEditPost)) {
		$postErrorMessage = "You must write a message !";
	} else {
		$postEditQuery = "UPDATE posts SET postContent=? WHERE postId=?";
		//? => à compléter dans l'execution ligne 19
		$postEdit = $bdd->prepare($postEditQuery);
		$postEdit->execute([$newEditPost, $lastPostId]); 
	}
	header("Location: ../posts.php?id=$topicId");
?>