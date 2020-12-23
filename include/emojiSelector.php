<?php
function fullEmojiSelector($postId){
	if(isset($_SESSION["userId"])){
		?>
		<div class="d-flex flex-row emojis-selector m-0 justify-content-end position-relative">
			<button class="emoji-button btn mr-2" 
				type="button" 
				data-toggle="collapse" 
				data-target="#emojis-menu-<?= $postId; ?>" 
				aria-expanded="false" 
				aria-controls="emojis-menu-<?= $postId; ?>">
					😀
			</button>
			<div id="emojis-menu-<?= $postId; ?>" 
				class="emojis emojis-menu collapse position-absolute r-0"
				aria-labelledby="emojis-menu-<?= $postId; ?>"
				data-parent="#topicContent"
				postId="<?= $postId; ?>">
			</div>
		</div>
		<?php
	}
}
?>
