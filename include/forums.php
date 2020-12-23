<div class="forums container-fluid col-12 col-md-9 p-5">
	<?php $forumId = $_GET["id"]; ?>

	<?php 
		$forumQuery = "SELECT forumName FROM forums WHERE forumId = ?";
		$forumResult = $bdd->prepare($forumQuery);
		$forumResult->execute([$forumId]);
		$forum = $forumResult->fetch(PDO::FETCH_ASSOC);
if($forum){
	?>

	<div class="Topic-title"> <p><?= $forum["forumName"]; ?></p></div>

	<!-- BOUTON FORUM RULES -->
    <?php include "include/forum_rules.php"; ?>
	<div class="buttons">
	<div class ="row p-2">
		<a href="newTopic.php?id=<?= $forumId; ?>" class="btn-success rounded-pill p-2 m-2 reply">
			New topic
		</a>
		<button class="setting">
			<img class="settingIcon" src="pictures/icons/sort-desc.svg" alt="">
		</button>
		<form method="post" action="search.php?forumId=<?= $forumId; ?>"class="row ml-3 mr-3">
			<div>
				<input type="text" id="search" name="search" placeholder="Search this forum…" class="search">
			</div>
			<button type="submit" class="setting"><img class="settingIcon" src="pictures/icons/search.svg" alt=""></button>
		</form>
		<button class="setting"><img class="settingIcon" src="pictures/icons/settings.svg" alt=""></button>  
</div>  <!--END OF BUTTONS-->

	</div>
	<div class="rounded border container">
		<div class="forums__header row bg-success align-items-center">
			<p class="col-9 m-0">Topics</p>
			<div class="col-1 d-flex justify-content-center">
				<img class="m-0 settingIcon" src="pictures/icons/message-circle.svg" alt="msg">
			</div>
			<div class="col-2 d-flex justify-content-center">
				<img class="m-0 settingIcon" src="pictures/icons/clock.svg" alt="last updated">
			</div>
		</div>
        <?php
			if($forumId == 13){
				$topicsQuery = "SELECT * FROM topics WHERE topicForumId = ? ORDER BY topicId DESC LIMIT 5";
			} else {
				$topicsQuery = "SELECT * FROM topics WHERE topicForumId = ? ORDER BY topicId DESC";
			}
			$topicsResult = $bdd->prepare($topicsQuery);
			$topicsResult->execute(array($forumId));
            while ($topicRow = $topicsResult->fetch(PDO::FETCH_ASSOC)) {
				
				$totalPostsQuery = "SELECT COUNT(*) AS 'total' FROM posts WHERE postTopicId = ?";
				$totalPostsResult = $bdd->prepare($totalPostsQuery);
				$totalPostsResult->execute(array($topicRow["topicId"]));
				$totalPosts = $totalPostsResult->fetch(PDO::FETCH_ASSOC);

				$authorQuery = "SELECT username, userId FROM users WHERE userId = ?";
				$authorResult = $bdd->prepare($authorQuery);
				$authorResult->execute(array($topicRow["topicAuthorId"]));
				$author = $authorResult->fetch(PDO::FETCH_ASSOC);
				
				$lastPostQuery = "
					SELECT users.username, users.userId, posts.postDate
					FROM users
					LEFT JOIN posts
					ON posts.postUserId = users.userId
					WHERE postTopicId = ? 
					ORDER BY postId DESC 
					LIMIT 1";
				$lastPostResult = $bdd->prepare($lastPostQuery);
				$lastPostResult->execute(array($topicRow["topicId"]));

        ?>
		<div class="row border-top align-items-center p-1">
			<div class="col-9 m-0">
				<a href="posts.php?id=<?= $topicRow["topicId"]; ?>">
					<?= $topicRow["topicTitle"]; ?>
				</a>
				<br>
				<span class="smaller">
					<span class="text-muted">By</span>
					<a href="profile.php?id=<?= $author["userId"]; ?>">
						<?= $author["username"]; ?>
					</a>
				</span>
			</div>
			<p class="col-1 m-0 text-center"><?= $totalPosts["total"]; ?></p>
			<!-- <p class="col-1 m-0 text-center">TO DO</p> -->
			<p class="col-2 m-0 text-center">
				<?php			
					while($lastPost = $lastPostResult->fetch(PDO::FETCH_ASSOC)){
						$date = new DateTime($lastPost['postDate']);
				?>
				<a href="profile.php?id=<?= $lastPost["userId"]; ?>">
					<?= $lastPost["username"]; ?>
				</a>
				<br>
				<span class="text-muted smaller"><?= $date->format('j M Y'); ?></span>
				<?php
					}
				?>
			</p>
		</div>
        <?php
            }
        ?>

	</div>
	<div class ="row p-2">
		<a href="newTopic.php?id=<?= $forumId; ?>" class="btn-success rounded-pill p-2 m-2 reply">
			New topic
		</a>
		<button class="m-2 setting">Tri</button>
	</div>
	<?php
}else{
    include("include/no_post.php");
}
?>
</div>

