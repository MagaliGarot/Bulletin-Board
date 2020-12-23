<?php
	session_start();
	include("bdd.php");
	//deletePostarea -> nom du textearea -> editDeletePost.php
	//Variable déclarée dans ContentPost ---> $postRow["postDate"]; $lastPostId = $postRow['postId']; $lastPostMs = $postRow['postContent'];
	$lastPostId = $_SESSION["lastPostId"];
	unset($_SESSION["lastPostId"]);
	$topicId = $_SESSION["topicId"];
	unset($_SESSION["topicId"]);

	//unset() détruit la ou les variables dont le nom a été passé en argument var.
		$postDeleteQuery = "DELETE FROM posts WHERE postId=?";
		$postDelete = $bdd->prepare($postDeleteQuery);
		$postDelete->execute([$lastPostId]); 
	
	header("Location: ../posts.php?id=$topicId");
?>