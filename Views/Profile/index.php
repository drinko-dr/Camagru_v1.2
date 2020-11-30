<section class="hero is-medium is-light is-bold" style="margin-top: -80px;">
  <div class="hero-body">
    <div class="container">
    <div class="image is-128x128" style="float:right;">
		<img src="<?php echo $user['profil_pic']; ?>" alt="profil-picture">
		<?php if ($user['id'] == $_SESSION['id']) : ?>
		<form id="form2" action="/index.php/profile/update_profile_picture" method="post">
			<input id="profil-pic-upload" type="file" accept="image/x-png, image/jpeg" name="profile-pic" onchange="update_profile_pic()">
			<button id="profil-pic" class="button is-info" style="display:none;">Change</button>
		</form>
		<?php endif; ?>
      </div>
      <h1 class="title"><?php echo $user['pseudo'] ?></h1>
      <h2 class="subtitle">
        <?php echo $posts_count; ?> post<?php if ($posts_count > 1) {echo 's';}?>   <?php echo $comments_count; ?> comment<?php if ($comments_count > 1) {echo 's';}?>  <?php echo $likes_count; ?> like<?php if ($likes_count > 1) {echo 's';}?>
      </h2>
      <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $user['id']) : ?>
            <a href="/index.php/profile/edit" class="button is-info">Edit profile</a>
            <a href="/index.php/studio" class="button is-info">New post</a>
        <?php endif; ?>
    </div>
  </div>
</section>

<div class="tabs is-centered">
  <ul>
    <li id="li-posts" class="is-active" onclick="show_posts()">
      <a>
        <span class="icon is-small"><i class="fas fa-image" aria-hidden="true"></i></span>
        <span>Posts</span>
      </a>
    </li>
    <li  id="li-comments" onclick="show_comments()">
      <a>
        <span class="icon is-small"><i class="fas fa-comment" aria-hidden="true"></i></span>
        <span>Comments</span>
      </a>
    </li>
    <li  id="li-likes" onclick="show_likes()">
      <a>
        <span class="icon is-small"><i class="fas fa-heart" aria-hidden="true"></i></span>
        <span>Likes</span>
      </a>
    </li>
  </ul>
</div>


<div id="posts" class="container" style="padding-top:60px;display:none;">
<?php if (count($posts) == 0) {
		echo "<div class='wrapper-box box'><p>" . $user['pseudo'] . " has not posted already.</p></div>";
	} ?>
    <div class="gallery">
    <?php 
    foreach ($posts as $post): ?>
        <div class="gallery-item">
            <img src="/<?= $post['img'] ?>" class="gallery-image" alt="">
            <div class="gallery-item-info" onclick="location.href = '/index.php/post?post_id=<?php echo $post['post_id']; ?>'">
                <ul>
                    <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> <?= $post['likes_count'] ?></li>
                    <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> <?= $post['comments_count'] ?></li>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <!-- End of gallery -->
</div>
	<!-- End of container -->

<div id="comments" class="wrapper-box box" style="padding-top:60px;display:none;">

	<?php if (count($comments) == 0) {
		echo "<p>" . $user['pseudo'] . " has no comments to show.</p>";
	}
	foreach ($comments as $comment): ?>
	<article class="media box">
	  <figure class="media-left">
	    <p class="image is-64x64">
	      <img src="<?= $user['profil_pic'] ?>">
	    </p>
	  </figure>
	  <div class="media-content">
	    <div class="content">
	      <p>
	        <strong><a href="/index.php/profile?user=<?= $user['pseudo']?>"><?= $user['pseudo'] ?></a></strong> <small><span class="timestamp"><?= $comment['creation_date'] ?></span></small>
			<br>
			<?= $comment['content'] ?>
	      </p>
	    </div>
	    <nav class="level is-mobile">
	      <div class="level-left">
		  <a href="/index.php/post?post_id=<?= $comment['post_id'] ?>" class="level-item" style="text-decoration:none">Click to see</a>
	      </div>
	    </nav>
	  </div>
</article>
     <?php endforeach; ?>

</div>

<div id="likes" class="wrapper-box box" style="padding-top:60px;display:none;">

    <?php if (count($likes) == 0) {
		echo "<p>" . $user['pseudo'] . " has not liked any post.</p>";
	}
    foreach ($likes as $like): ?>
		<div class="notification is-primary">
			<p><?= $user['pseudo'] ?> liked a post.</p>
			<a href="/index.php/post?post_id=<?= $like['post_id'] ?>">Click to see</a>
		</div>
    <?php endforeach; ?>

</div>

<script src="/assets/js/profile.js"></script>