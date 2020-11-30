function getBase64value(file, element) {
	var reader = new FileReader();
	reader.readAsDataURL(file);
	reader.onload = function () {
		element.value = reader.result;
	};
	reader.onerror = function (error) {
	  console.log('Error: ', error);
	};
 }

function getBase64(file, element) {
	var reader = new FileReader();
	reader.readAsDataURL(file);
	reader.onload = function () {
		element.src = reader.result;
	};
	reader.onerror = function (error) {
	  console.log('Error: ', error);
	};
 }

function show_comments() {
	comments.style.display = "block";
	gallery.style.display = "none";
	likes.style.display = "none";

	li_comments.classList.add("is-active");
	li_likes.classList.remove("is-active");
	li_posts.classList.remove("is-active");
}

function show_likes() {
	comments.style.display = "none";
	gallery.style.display = "none";
	likes.style.display = "block";

	li_likes.classList.add("is-active");
	li_comments.classList.remove("is-active");
	li_posts.classList.remove("is-active");
}

function show_posts() {
	comments.style.display = "none";
	gallery.style.display = "block";
	likes.style.display = "none";

	li_posts.classList.add("is-active");
	li_likes.classList.remove("is-active");
	li_comments.classList.remove("is-active");
}

function update_profile_pic() {
	var files = document.getElementById("profil-pic-upload").files;
	if (files.length > 0) {
		var input = document.createElement('input');
		input.setAttribute('type', 'hidden');
		input.setAttribute('name', 'image');

		getBase64value(files[0], input);

		input.src.toDataURL;
		document.getElementById("form2").appendChild(input);
		var submit = document.getElementById("profil-pic");
		submit.style.display = "block";	
	}
}


window.onload = function () {
	gallery = document.getElementById("posts");
	comments = document.getElementById("comments");
	likes = document.getElementById("likes");

	li_posts = document.getElementById("li-posts");
	li_comments = document.getElementById("li-comments");
	li_likes = document.getElementById("li-likes");

	show_posts();
}