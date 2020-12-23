<div class="Breadcrumb p-3">

<?php

	$path = $_SERVER['PHP_SELF'];
	$cuttedPath = explode("/", explode(".php", $path)[0]);
	$location = end($cuttedPath);

	function getTopic($id){
		global $bdd;
		$query = "SELECT topicTitle, topicForumId FROM topics WHERE topicId = ?";
		$result = $bdd->prepare($query);
		$result->execute([$id]);
		return $result->fetch(PDO::FETCH_ASSOC);
	}

	function getForum($id){
		global $bdd;
		$query = "SELECT forumName FROM forums WHERE forumId = ?";
		$result = $bdd->prepare($query);
		$result->execute([$id]);
		return $result->fetch(PDO::FETCH_ASSOC);
	}

	switch ($location) {
		case "posts":
		case "newPost":
			$id = $_GET['id'];
			$topic = getTopic($id);
			$forum = getForum($topic["topicForumId"]);
			?>
				<p>
					<a href="index.php"> Home </a>
					>
					<a href="forum.php?id=<?= $topic["topicForumId"]; ?>"> <?= $forum["forumName"]; ?> </a>
					>
					<a href="posts.php?id=<?= $id; ?>"> <?= $topic["topicTitle"]; ?> </a>
				</p>
			<?php
			break;
		case "forum":
		case "newTopic":
			$id = $_GET['id'];
			$forum = getForum($id);
			?>
				<p>
					<a href="index.php"> Home </a>
					>
					<a href="forum.php?id=<?= $id; ?>"> <?= $forum["forumName"]; ?> </a>
				</p>
			<?php
			break;
		case "profile":
			?>
				<p>
					<a href="index.php"> Home </a>
					>
					<a href="profile.php"> Profile </a>
				</p>
			<?php
			break;
		case "register":
			?>
				<p>
					<a href="index.php"> Home </a>
					>
					<a href="register.php"> Register </a>
				</p>
			<?php
			break;
		default:
			?>
				<p>
					<a href="index.php"> Home </a>
				</p>
			<?php
	}
	?>

</div>
