<div class="forums container-fluid col-12 col-md-9 p-5">
	<?php

	if(isset($_POST["search"])){
		$search = $_POST["search"];

		
		if(isset($_GET["topicId"])) {
			$topicId = $_GET["topicId"];

			?><h3>Results for the search of <strong><?= $search; ?></strong> :</h3><?php
		
			$searchQuery = "SELECT posts.postContent, posts.postDate, users.userId, users.username
				FROM posts 
				LEFT JOIN users ON posts.postUserId=users.userId
				WHERE postContent LIKE '%".$search."%' AND posts.postTopicId = ?";
			$searchResult = $bdd->prepare($searchQuery);
			$searchResult->execute([$topicId]);

			/* IF THERE IS RESULTS */
			if($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC)){
				do {
					?>
						<div class="card bg-light mb-3 lastpost">
							<div class="card-header">
								<strong>
									By 
									<a class="poststitle" href="profile.php?id=<?= $searchRow["userId"]; ?>">
										<?= $searchRow["username"]; ?>
									</a>
									the <?= $searchRow["postDate"]; ?>
								</strong>
							</div>
							<div class="card-body">
								<div class="card-text">
									<?= Michelf\MarkdownExtra::defaultTransform($searchRow['postContent']); ?>
								</div>
							</div>
						</div>
					<?php
				} while($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC));
			/* IF THERE IS NO RESULT */
			} else {
				?>
					<div class="noPost">
					<h3 class="Become">Sadly, we found nothing concerning your search.</h3>

					<button type="submit" name="myProfil" class="w-100 btn btn-success">
					<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>"><strong>Previous page</strong></a>
					</button>
					
					<button type="submit" name="myProfil" class="w-100 btn btn-success">
					<?php echo "<a href='index.php'> <strong>Let's go to the boards</strong> </a>" ?>
					</button>

					</div>

				<?php
			}
		
		} elseif (isset($_GET["forumId"])) {

			$forumId = $_GET["forumId"];

			?><h3>Results for the search of <strong><?= $search; ?></strong> :</h3><?php

			$searchQuery = "SELECT topics.topicId, topics.topicTitle, topics.topicAuthorId, users.username
				FROM topics
				LEFT JOIN users ON topics.topicAuthorId=users.userId
				WHERE topicTitle LIKE '%".$search."%' AND topics.topicForumId = ?";
			$searchResult = $bdd->prepare($searchQuery);
			$searchResult->execute([$forumId]);

			$gotResults = 0;

			/* IF THERE IS RESULTS */
			if($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC)){
				$gotResults++;

				?><h4 class="mt-5">Topics : </h4><?php
				do {
					?>
						<div class="card bg-light mb-3 lastpost">
							<div class="card-header">
								<strong>
									<a class="poststitle" href="posts.php?id=<?= $searchRow["topicId"]; ?>">
										<?= $searchRow["topicTitle"]; ?>
									</a>
									by
									<a class="poststitle" href="profile.php?id=<?= $searchRow["topicAuthorId"]; ?>">
										<?= $searchRow["username"]; ?>
									</a>
								</strong>
							</div>
						</div>
					<?php
				} while($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC));
			}

			$searchQuery = "SELECT posts.postContent, posts.postTopicId, posts.postDate, users.userId, users.username
				FROM posts 
				LEFT JOIN users ON posts.postUserId=users.userId
				WHERE postContent LIKE '%".$search."%'";
			$searchResult = $bdd->prepare($searchQuery);
			$searchResult->execute();

			/* IF THERE IS RESULTS */
			if($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC)){

				do {
					
					$postTopicQuery = "SELECT topicForumId, topicTitle from topics WHERE topicId = ?";
					$postTopicResult = $bdd->prepare($postTopicQuery);
					$postTopicResult->execute([$searchRow["postTopicId"]]);
					$postTopic = $postTopicResult->fetch(PDO::FETCH_ASSOC);
					if($postTopic["topicForumId"] == $forumId){
						if(!isset($gotPostsResult)){
							$gotPostsResult = TRUE;
							?><h4 class="mt-5">Posts : </h4><?php
						}
						$gotResults++;

						?>
							<div class="card bg-light mb-3 lastpost">
								<div class="card-header">
									<strong>
										By 
										<a class="poststitle" href="profile.php?id=<?= $searchRow["userId"]; ?>">
											<?= $searchRow["username"]; ?>
										</a>
										on the topic 
										<a class="poststitle" href="posts.php?id=<?= $searchRow["postTopicId"]; ?>">
											<?= $postTopic["topicTitle"]; ?>
										</a>
									</strong>
								</div>
								<div class="card-body">
									<div class="card-text">
										<?= Michelf\MarkdownExtra::defaultTransform($searchRow['postContent']); ?>
									</div>
								</div>
							</div>
						<?php
					}
				} while($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC));
			}
			
			/* IF THERE IS NO RESULT */
			if ($gotResults == 0) {
				?>
				<div class="noPost">
					<h3 class="Become">Sadly, we found nothing concerning your search.</h3>

					<button type="submit" name="myProfil" class="w-100 btn btn-success">
					<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>"><strong>Previous page</strong></a>
					</button>
					
					<button type="submit" name="myProfil" class="w-100 btn btn-success">
					<?php echo "<a href='index.php'> <strong>Let's go to the boards</strong> </a>" ?>
					</button>

					</div>
				
				<?php
			}

		} else {
			$gotResults = 0;
		
			?><h3 class="mb-3">Results for the search of <strong><?= $search; ?></strong> :</h3><?php

			$searchQuery = "SELECT forumId, forumName, forumBoardId
			FROM forums
			WHERE forumName LIKE '%".$search."%'";
			$searchResult = $bdd->prepare($searchQuery);
			$searchResult->execute();

			/* IF THERE IS RESULTS */
			if($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC)){
				$gotResults++;

				?><h4 class="mt-5">Forums : </h4><?php
				do {

					$boardQuery = "SELECT boardsName FROM boards WHERE boardsId = ?";
					$boardResult = $bdd->prepare($boardQuery);
					$boardResult->execute([$searchRow["forumBoardId"]]);
					$board = $boardResult->fetch(PDO::FETCH_ASSOC);

					?>
						<div class="card bg-light mb-3 lastpost">
							<div class="card-header">
								<strong>
									<a class="poststitle" href="forum.php?id=<?= $searchRow["forumId"]; ?>">
										<?= $searchRow["forumName"]; ?>
									</a>
									on the board <?= $board["boardsName"]; ?>
								</strong>
							</div>
						</div>
					<?php
				} while($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC));
			}

			$searchQuery = "SELECT topics.topicId, topics.topicTitle, topics.topicAuthorId, users.username
				FROM topics
				LEFT JOIN users ON topics.topicAuthorId=users.userId
				WHERE topicTitle LIKE '%".$search."%'";
			$searchResult = $bdd->prepare($searchQuery);
			$searchResult->execute();


			/* IF THERE IS RESULTS */
			if($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC)){
				$gotResults++;

				?><h4 class="mt-5">Topics : </h4><?php
				do {
					?>
									<div class="noPost">
					<h3 class="Become">Sadly, we found nothing concerning your search.</h3>

					<button type="submit" name="myProfil" class="w-100 btn btn-success">
					<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>"><strong>Previous page</strong></a>
					</button>
					
					<button type="submit" name="myProfil" class="w-100 btn btn-success">
					<?php echo "<a href='index.php'> <strong>Let's go to the boards</strong> </a>" ?>
					</button>

					</div>
						<div class="card bg-light mb-3 lastpost">
							<div class="card-header">
								<strong>
									<a class="poststitle" href="posts.php?id=<?= $searchRow["topicId"]; ?>">
										<?= $searchRow["topicTitle"]; ?>
									</a>
									by
									<a class="poststitle" href="profile.php?id=<?= $searchRow["topicAuthorId"]; ?>">
										<?= $searchRow["username"]; ?>
									</a>
								</strong>
							</div>
						</div>
					<?php
				} while($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC));
			}

			$searchQuery = "SELECT posts.postContent, posts.postTopicId, posts.postDate, users.userId, users.username
				FROM posts 
				LEFT JOIN users ON posts.postUserId=users.userId
				WHERE postContent LIKE '%".$search."%'";
			$searchResult = $bdd->prepare($searchQuery);
			$searchResult->execute();

			/* IF THERE IS RESULTS */
			if($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC)){
				?><h4 class="mt-5">Posts : </h4><?php
				$gotResults++;

				do {
					
					$postTopicQuery = "SELECT topicTitle from topics WHERE topicId = ?";
					$postTopicResult = $bdd->prepare($postTopicQuery);
					$postTopicResult->execute([$searchRow["postTopicId"]]);
					$postTopic = $postTopicResult->fetch(PDO::FETCH_ASSOC);
					

					?>
						<div class="card bg-light mb-3 lastpost">
							<div class="card-header">
								<strong>
									By 
									<a class="poststitle" href="profile.php?id=<?= $searchRow["userId"]; ?>">
										<?= $searchRow["username"]; ?>
									</a>
									on the topic 
									<a class="poststitle" href="posts.php?id=<?= $searchRow["postTopicId"]; ?>">
										<?= $postTopic["topicTitle"]; ?>
									</a>
								</strong>
							</div>
							<div class="card-body">
								<div class="card-text">
									<?= Michelf\MarkdownExtra::defaultTransform($searchRow['postContent']); ?>
								</div>
							</div>
						</div>
					<?php
				} while($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC));
			}

			$searchQuery = "SELECT * FROM users WHERE username LIKE '%".$search."%'";
			$searchResult = $bdd->prepare($searchQuery);
			$searchResult->execute();

			/* IF THERE IS RESULTS */
			if($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC)){
				$gotResults++;

				?><h4 class="mt-5">Users : </h4><?php
				do {
					

					?>
						<div class="card bg-light mb-3 lastpost">
							<div class="card-header">
								<strong>
									<a class="poststitle" href="profile.php?id=<?= $searchRow["userId"]; ?>">
										<?= $searchRow["username"]; ?>
									</a>
								</strong>
							</div>
						</div>
					<?php
				} while($searchRow = $searchResult->fetch(PDO::FETCH_ASSOC));
			}
			
			/* IF THERE IS NO RESULT */
			if ($gotResults == 0) {
				?>

					<div class="noPost">
					<h3 class="Become">Sadly, we found nothing concerning your search.</h3>

					<button type="submit" name="myProfil" class="w-100 btn btn-success">
					<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>"><strong>Previous page</strong></a>
					</button>
					
					<button type="submit" name="myProfil" class="w-100 btn btn-success">
					<?php echo "<a href='index.php'> <strong>Let's go to the boards</strong> </a>" ?>
					</button>

					</div>
					
				<?php
			}

		}
	} else {
		?>
			<h3 class="justify-self-center p-5">Oops, it seems like something went wrong. </h3>
			<p>In order to make a proper search on this website, use the search forms and enter the exact expression you're looking for.</p>
		<?php
	}
	?>
</div>