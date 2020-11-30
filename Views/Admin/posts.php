<div style="width:90%;margin:auto;">
<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th>Image</th>
      <th>ID</th>
      <th>Author</th>
      <th>Caption</th>
      <th>Comments</th>
      <th>Likes</th>
      <th>Creation Date</th>
      <th>See post</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($posts) > 0) {
		foreach ($posts as $post) : ?>
    <tr>
      <th><div class="image is-64x64"><img src="/<?= $post['image'] ?>"></div></th>
      <th><?= $post['id'] ?></th>
      <th><?= $post['author']['pseudo'] ?></th>
      <th><?= $post['caption'] ?></th>
      <th><?= $post['comments_count'] ?></th>
      <td><?= $post['likes_count'] ?></td>
      <th><?= $post['creation_date'] ?></th>
      <th><a href="/index.php/post?post_id=<?= $post['post_id'] ?>">See post</a></th>
      <th><a href="/index.php/post/delete_post?post_id=<?= $post['id']?>">Delete post</a></th>
     </tr>
  <?php endforeach;} ?>
  </tbody>
</table>
</div>
