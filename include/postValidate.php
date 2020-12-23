<?php
session_start();
include("bdd.php");
$message = htmlspecialchars($_POST['message']);

$topicId = $_SESSION["topicId"];
unset($_SESSION["topicId"]);
$message = $_POST["message"];

if(empty($message)) {
	$postErrorMessage = "You must write a message !";
} else {
	$newPostQuery = "INSERT INTO posts (postUserId, postTopicId, postContent) VALUES (?, ?, ?)";
	$newPostResult = $bdd->prepare($newPostQuery);
	$newPostResult->execute([$_SESSION["userId"], $topicId, $message]);
}
header("Location: ../posts.php?id=$topicId");
?>