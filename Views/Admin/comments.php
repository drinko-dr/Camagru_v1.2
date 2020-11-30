<div style="width:90%;margin:auto;">
<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th>ID</th>
      <th>Author</th>
      <th>Content</th>
      <th>Post related</th>
      <th>Creation Date</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($comments) > 0) {
		foreach ($comments as $comment) : ?>
    <tr>
      <th><?= $comment['id'] ?></th>
      <th><?= $comment['author']['pseudo'] ?></th>
      <th><?= $comment['content'] ?></th>
      <th><a href="/index.php/post?post_id=<?= $comment['post_id']?>">See post</a></th>
      <th><?= $comment['creation_date'] ?></th>
      <th>
	  <form action="/index.php/comment/delete_comment" method="post">
			<button type="submit" class="button is-info">Delete</button>
			<input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
		</form>
	  </th>
     </tr>
  <?php endforeach;
  } ?>
  </tbody>
</table>
</div>