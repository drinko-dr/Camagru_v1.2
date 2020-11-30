<br />
<h1 class="title is-3 center">Notifications</h1>
<br />
<div class="tile is-ancestor">
	<div class="tile is-4"></div>
	<div class="tile is-4 is-vertical">
	<?php if (!$notifications) : ?>
		<p>You have no new notification</p>
	<?php else : 
	foreach ($notifications as $notif) : ?>
	    
			<div class="notification <?php echo $notif['object'] == "New comment" ? "is-primary" : "is-danger"; ?>">
				<a href="/index.php/notification/delete?id=<?= $notif['id'] ?>&user_id=<?= $notif['user_id'] ?>" class="delete">
				</a>
				<a href="/index.php/post?post_id=<?= $notif['post_id'] ?>" style="text-decoration:none;">
				<p><?= $notif['object'] ?>!</p>
				<p><?= $notif['content'] ?>
				<p class="timestamp"><?= $notif['creation_date'] ?></p>
				</a>
	    	</div>
	<?php endforeach; endif; ?>
	</div>
	<div class="tile is-4"></div>
</div>

<script>

function timeDifference(current, previous) {
	var msPerMinute = 60 * 1000;
	var msPerHour = msPerMinute * 60;
	var msPerDay = msPerHour * 24;
	var msPerMonth = msPerDay * 30;
	var msPerYear = msPerDay * 365;
	var elapsed = current - previous;
	if (elapsed < msPerMinute) {
		return Math.round(elapsed / 1000) + ' seconds ago';
	}
	else if (elapsed < msPerHour) {
		return Math.round(elapsed / msPerMinute) + ' minutes ago';
	}
	else if (elapsed < msPerDay) {
		return Math.round(elapsed / msPerHour) + ' hours ago';
	}
	else if (elapsed < msPerMonth) {
		return 'approximately ' + Math.round(elapsed / msPerDay) + ' days ago';
	}
	else if (elapsed < msPerYear) {
		return 'approximately ' + Math.round(elapsed / msPerMonth) + ' months ago';
	}
	else {
		return 'approximately ' + Math.round(elapsed / msPerYear) + ' years ago';
	}
}

var now = new Date(Date.now()).getTime();
var pouet = document.getElementsByClassName("timestamp");

for (var i = 0; i < pouet.length; i++) {
	// var creation_date = pouet[i].innerHTML;
	var date = pouet[i].innerHTML;

	// Split timestamp into [ Y, M, D, h, m, s ]
	var t = date.split(/[- :]/);
	var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
	var d = d.getTime();

	pouet[i].innerHTML = timeDifference(now, d);
}

</script>
