 <div class="post-box box" style="position:relative;">
<br />
	<!-- DELETE POST SECTION -->
	<p id="post_timestamp" style="position:absolute;top:15px;right:15px;"><?php echo $post['creation_date']; ?></p>
	<br />
	<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $post['user_id']) : ?>
        <form name="post_delete" action="/index.php/post/delete_post" method="post" style="float:right;">
            <button class="button is-danger" type="submit" name="submit">Delete this post</button>
            <input type="hidden" name="post_id" value="<?= $post['post_id']; ?>">
        </form>
    <?php endif ?>
		<!-- POST AUTHOR -->
	<div style="float:left;">
		<a href="/index.php/profile?user=<?php echo $user['pseudo']; ?>" class="title"><?= $user['pseudo'] ?></a>
    	<p ><?php echo $post['caption']; ?></p>
	</div>

	<!-- IMAGE -->
	<div class="image is-3by2 is-center" style="width:90%;margin:auto;margin-top:60px;">
    	<img src="/<?php echo $post['img']; ?>">
	</div>

    <!-- LIKES AND COMMENTS SECTION -->
    <div class="level">
		<div class="level-left">
 			<div class="level-item">
			 	<p><?php echo count($comments); ?> comment<?php if (count($comments) > 1) {echo 's';}?></p>
			 </div>
		</div>
		<div class="level-right">
			<div class="level-item">
				<?php if (isset($_SESSION['id'])) : ?>
	        	<form id="like-form" action="/index.php/post/like" method="post">
	            <button id="submit-btn" type="submit" class="fabutton" style="margin-top:5px;font-size:16px;" onclick="like_post()">
	                <span id="log-like"><?php echo count($likes); ?></span> <i class="fa fa-heart fa-2x <?php if ($user_liked) {echo "liked";} ?>"></i>
	            </button>
	            <input type="hidden" name="like" value="yes">
	            <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
	         </form>
	         <?php endif; if (!isset($_SESSION['id'])) : ?>
	        <p style="width: 50%;text-align:right; font-size:16px;">
	            <span id="unlog-like"><?php echo count($likes); ?></span> <i class="fa fa-heart fa-2x <?php if ($user_liked) {echo "liked";} ?>"></i>
	        </p>
	         <?php endif; ?>
			</div>
		</div>
	</div>

    <?php if (isset($_SESSION['id'])) : ?>
	<article class="media">
		<figure class="media-left">
			<p class="image is-64x64">
			  <img src="<?php echo $_SESSION['profil_pic']; ?>">
			</p>
		</figure>
		<div class="media-content">
		<form action="/index.php/post/new_comment" method="post" style="">
			<div class="field">
			  <p class="control">
			    <textarea class="textarea" name="comment_content" placeholder="Add a comment..." required></textarea>
			  </p>
			</div>
			<nav class="level">
			  <div class="level-left">
			    <div class="level-item">
				  <button class="button is-info" type="submit">Submit</button>
				  <input type="hidden" name="post_id" value="<?php echo $post['post_id'];?>">
			    </div>
			  </div>
			</nav>
			</form>
		</div>
	</article>
     <?php else : ?>
    <p>
        <a href="/index.php/login">Log in</a> or <a href="/index.php/register">register</a> to post a comment.
    </p>
     <?php endif; ?>
    <br />

     <?php foreach ($comments as $comment): ?>
	<article class="media">
	  <figure class="media-left">
	    <p class="image is-64x64">
	      <img src="<?= $comment['profil_pic'] ?>">
	    </p>
	  </figure>
	  <div class="media-content">
	    <div class="content">
	      <p>
	        <strong><a href="/index.php/profile?user=<?= $comment['user_pseudo']?>"><?= $comment['user_pseudo'] ?></a></strong> <small><span class="timestamp"><?= $comment['creation_date'] ?></span></small>
			<br>
			<?= $comment['content'] ?>
	      </p>
	    </div>
	  </div>
	  <?php if (!empty($_SESSION['id']) && $comment['user_id'] == $_SESSION['id']) : ?>
	  <div class="media-right">
		  <form action="/index.php/comment/delete_comment" method="post">
				<button class="delete" type="submit"></button>
				<input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
		</form>
	  </div>
	<?php endif; ?>
</article>
     <?php endforeach; ?>
</div>


<script src="/assets/js/timestamps.js"></script>
<script src="/assets/js/like.js"></script>
