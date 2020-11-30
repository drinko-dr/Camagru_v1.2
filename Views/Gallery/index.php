<div class="container">
    <h1 class="is-size-4 is-light">Discover lasts Camagrus.</h1>

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
	
	<nav class="pagination" role="navigation" aria-label="pagination">
  		<a class="pagination-previous" title="Previous" href="/index.php/gallery?page=<?php echo $page - 1; ?>" <?php if ($page == 1) {echo "disabled";}?>>Previous</a>
		<a class="pagination-next" <?php if ($page == $nbpage || $nbpage == 0) {echo "disabled";}?> href="/index.php/gallery?page=<?php echo $page + 1; ?>">Next page</a>
		<ul class="pagination-list">
		<?php for ($i = 1; $i <= $nbpage; $i++) : ?>
			<li><a class="pagination-link <?php if ($page == $i){echo "is-current";}?>" href="/index.php/gallery?page=<?= $i?>" aria-label="Page <?= $i ?>" aria-current="page"><?= $i ?></a></li>
		<?php endfor; ?>
		</ul>
	</nav>

</div>
