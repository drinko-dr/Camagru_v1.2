<div style="width:90%;margin:auto;">
<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th>ID</th>
      <th>Email</th>
      <th>Pseudo</th>
      <th>Notifications mail</th>
      <th>Posts</th>
      <th>Comments</th>
      <th>Likes</th>
      <th>Creation Date</th>
      <th>See profile</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($users) > 0) {
		foreach ($users as $user) : ?>
    <tr>
      <th><?= $user['id'] ?></th>
      <td><?= $user['email'] ?></td>
      <td><?= $user['pseudo'] ?></td>
      <td><?= $user['notification_mails'] ?></td>
      <td><?= $user['posts_count'] ?></td>
      <td><?= $user['comments_count'] ?></td>
      <td><?= $user['likes_count'] ?></td>
      <td><?= $user['creation_date'] ?></td>
      <td><a href="/index.php/profile?user=<?= $user['pseudo'] ?>">See profile</a>
     </tr>
  <?php endforeach; }?>
  </tbody>
</table>
</div>
