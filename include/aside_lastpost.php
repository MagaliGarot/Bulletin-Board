<h3 class="titlelastPost">Last Post</h3> 
<?php

$affichage = 0;

$lastPostQuery = 'SELECT postContent, postTopicId FROM posts ORDER BY postId DESC';
$postResult = $bdd-> query($lastPostQuery);

while ($affichage < 4){
    
    $post=$postResult->fetch(PDO::FETCH_ASSOC);

    $lastTopicQuery = 'SELECT topicForumId, topicTitle FROM topics WHERE topicId = ?';
    $lastTopic = $bdd->prepare($lastTopicQuery);
    $lastTopic->execute([$post['postTopicId']]);
    $topicTitle=$lastTopic->fetch(PDO::FETCH_ASSOC);

    $boardQuery = 'SELECT forumBoardId FROM forums WHERE forumId = ?';
    $boardResult = $bdd->prepare($boardQuery);
    $boardResult->execute([$topicTitle["topicForumId"]]);
    $forumRow = $boardResult->fetch(PDO::FETCH_ASSOC);

    $limit = 70;
    if (strlen($post['postContent']) > $limit){
      $points = '...';
    }else{
      $points = ' ';
    }
    if($forumRow['forumBoardId'] != 5){ 
        ?>
              <div class="card bg-light mb-3 lastpost">
                <div class="card-header headergreen">
                <strong>
                <!----- TEST ----->
                <a class="poststitle" href="posts.php?id=<?= $post["postTopicId"]; ?>">
					      <?= $topicTitle["topicTitle"]; ?>
			        	</a>
                </strong>
                </div>
                <div class="card-body">
                  <div class="card-text">
                      <?= substr(Michelf\MarkdownExtra::defaultTransform($post['postContent']), 0, $limit) . $points;
                    
                      ?>
                  </div>
                </div>
              </div>
        <?php $affichage++; 
    }
}
?>

