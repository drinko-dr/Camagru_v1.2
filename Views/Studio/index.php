<div class="tile is-ancestor">

<div class="tile is-1"></div>
<div id="studio" class="box tile is-7 is-parent">
	
	<div class="tile is-child is-vertical is-4">
		<h3 class="title is-size-5">Available filters:</h3>
		<?php foreach ($filters as $filter): ?>
			<div id="<?=$filter['id']?>-filter" class="filter-preview image is-128x128" onclick="setFilter('<?=$filter['id']?>')">
	  			<img src="<?=$filter['path']?>">
			</div>
		<?php endforeach;?>
	</div>
	<div class="tile is-parent is-vertical wrapper">
		<div id="rendering" class="tile is-child">
			<video id="stream" autoplay></video>

			<?php foreach ($filters as $filter): ?>
				<img id="<?=$filter['id']?>" class="video-filter" src="<?=$filter['path']?>" style="display: none">
			<?php endforeach;?>
			<img id="output"/>
		</div>

		<div class="tile is-child">
			<div id="studio-btns">
				<p id="warning-filter">You must select a filter before taking a shot.</p>
				<button id="snap-button" class="button is-info" style="display:none;">Take picture</button>
				<p>Upload a file instead :</p>
				<input id="file" type="file" accept="image/x-png, image/jpeg" oninput="loadFile(event)">
			</div>

			<form id="form" action="<?php echo WEBROOT . 'index.php/Studio/save'; ?>" method="post">
				<input type="text" class="input" name="caption" placeholder="Add a caption to your photo"><br />
				<input id="filter-input" type="hidden" name="filter" value="">
			</form>
		</div>
		
	</div>
</div>

<div class="tile is-1"></div>

<!-- Previous pictures -->
<div class="tile is-vertical box">
	<h1>Lasts shots :</h1>
	<div style="margin-left:auto;margin-right:auto;margin-top:20px;">
		<?php 
		foreach ($posts as $post): ?>
			<figure class="image is-128x128">
				<a href="/index.php/post?post_id=<?= $post['post_id'] ?>"><img src="/<?= $post['img'] ?>" class="" alt=""></a>
			</figure>
		<?php endforeach; ?>
	</div>

</div>
<div class="tile is-1"></div>


<script src="/Assets/js/script.js"></script>

