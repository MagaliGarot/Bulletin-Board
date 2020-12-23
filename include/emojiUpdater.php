<?php
	session_start();
	// mb_internal_encoding("UTF-8");
	// mb_http_output("UTF-8");
	include("bdd.php");

	$postId = "";
	$emoji = "";

	if(isset($_GET["postId"]) AND isset($_GET["emoji"])){
		$postId = $_GET["postId"];
		$emoji = $_GET["emoji"];
	}

	// try{
	// 	$emojiQuery = "INSERT INTO emotes (emote, emoteUserId, emotePostId) VALUES (?, ?, ?)";
	// 	$emojiResult = $bdd->prepare($emojiQuery);
	// 	$emojiResult->execute([$emoji, $_SESSION["userId"], $postId]);
	// 	$response_array['status'] = 'success';
	// } catch (PDOException $error) {
	// 	try{
	// 		$emojiQuery = "DELETE FROM emotes WHERE emote = ? AND emoteUserId = ? AND emotePostId = ?";
	// 		$emojiResult = $bdd->prepare($emojiQuery);
	// 		$emojiResult->execute([$emoji, $_SESSION["userId"], $postId]);
	// 		$response_array['status'] = 'success';
	// 	} catch (PDOException $error) {
	// 		http_response_code(500);
	// 		$response_array['error'] = $error->getMessage();
	// 	}
	// }

	$emojiQuery = "SELECT * FROM emotes WHERE emote = ? AND emoteUserId = ? AND emotePostId = ?";
	$emojiResult = $bdd->prepare($emojiQuery);
	$emojiResult->execute([$emoji, $_SESSION["userId"], $postId]);
	if($emojiResult->fetch()){
		try{
			$emojiQuery = "DELETE FROM emotes WHERE emote = ? AND emoteUserId = ? AND emotePostId = ?";
			$emojiResult = $bdd->prepare($emojiQuery);
			$emojiResult->execute([$emoji, $_SESSION["userId"], $postId]);
			$response_array['status'] = 'success';
		} catch (PDOException $error) {
			http_response_code(500);
			$response_array['error'] = $error->getMessage();
		}
	} else {
		try{
			$emojiQuery = "INSERT INTO emotes (emote, emoteUserId, emotePostId) VALUES (?, ?, ?)";
			$emojiResult = $bdd->prepare($emojiQuery);
			$emojiResult->execute([$emoji, $_SESSION["userId"], $postId]);
			$response_array['status'] = 'success';
		} catch (PDOException $error) {
			http_response_code(500);
			$response_array['error'] = $error->getMessage();
		}
	}

	// $emojiQuery = "IF EXISTS (SELECT * FROM emotes WHERE emote = :emote AND emoteUserId = :emoteUserId AND emotePostId = :emotePostId)
	// 	{
	// 		DELETE FROM emotes WHERE emote = :emote AND emoteUserId = :emoteUserId AND emotePostId = :emotePostId
	// 	}
	// 	ELSE
	// 	{
	// 		INSERT INTO emotes (emote, emoteUserId, emotePostId) VALUES (:emote, :emoteUserId, :emotePostId)
	// 	}";
	// $emojiResult = $bdd->prepare($emojiQuery);
	// $emojiResult->execute([
	// 	"emote" => $emoji, 
	// 	"emoteUserId" => $_SESSION["userId"],
	// 	"emotePostId" => $postId
	// ]);

	header('Content-type: application/json');
	echo json_encode($response_array);
?>