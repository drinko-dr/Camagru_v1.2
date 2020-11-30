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
var post = document.getElementById("post_timestamp");
var date = post.innerHTML;

// Split timestamp into [ Y, M, D, h, m, s ]
var t = date.split(/[- :]/);
var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
var d = d.getTime();


post.innerHTML = timeDifference(now, d);

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