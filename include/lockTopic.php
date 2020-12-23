<?php
	session_start();
	include("bdd.php");

	$topicId = $_SESSION["topicId"];
	unset($_SESSION["topicId"]);
	$isLocked = $_SESSION["isLocked"];
	unset($_SESSION["isLocked"]);

	$lockQuery = "UPDATE topics SET isLocked = ? WHERE topicId = ?";
	$lockResult = $bdd->prepare($lockQuery);
	if($isLocked == "1"){
		$lockResult->execute([0,$topicId]);
	}else{
		$lockResult->execute([1,$topicId]);
	}
	header("Location: ../posts.php?id=$topicId");
?>