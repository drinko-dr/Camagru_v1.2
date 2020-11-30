function setFilter(id) {
	var img = document.getElementById(id);
	var filterInput = document.getElementById('filter-input');
	var filters = document.getElementsByClassName("video-filter");
	var selected = document.getElementById(id.concat("-filter"));
	var unselect = document.getElementsByClassName('filter-preview');


	for (var i = 0; i < filters.length; i++) {
		filters[i].style.display = "none";
	}
	for (var i = 0; i < unselect.length; i++) {
		unselect[i].classList.remove("selected");
	}

	selected.classList.add("selected");
	img.style.display = "block";
	filterInput.value = id;


	document.getElementById('warning-filter').style.display = "none";
	button = document.getElementById('snap-button');
	button.style.display = "block";
	button.style.margin = "0 auto";
}

(function () {
	'use strict';
	var video = document.querySelector('video'),
		canvas;

	/**
	 *  generates a still frame image from the stream in the <video>
	 *  appends the image to the <body>
	 */
	function takeSnapshot() {
		var img = document.querySelector('img') || document.createElement('img');
		var context;
		var width = video.offsetWidth,
			height = video.offsetHeight;
		var rendering = document.getElementById("rendering");
		var form = document.getElementById('form');

		canvas = canvas || document.createElement('canvas');
		canvas.width = width;
		canvas.height = height;

		context = canvas.getContext('2d');
		context.drawImage(video, 0, 0, width, height);
		document.getElementById("stream").style.display = 'none';
		img.src = canvas.toDataURL('image/png');
		img.setAttribute('class', 'snapshot-img');
		img.style.display = "block";
		rendering.appendChild(img);

		var snapBtn = document.getElementById('snap-button');
		snapBtn.style.display = "none";
		document.getElementById('studio-btns').style.display = "none";

		var submit = document.createElement('input');
		submit.setAttribute('type', 'submit');
		submit.setAttribute('value', 'Save image');
		submit.setAttribute('class', 'button is-info')
		form.appendChild(submit);

		var input = document.createElement('input');
		input.setAttribute('type', 'hidden');
		input.setAttribute('name', 'image');
		input.value = canvas.toDataURL('image/png');
		form.appendChild(input);
		form.style.display = "block";
	}

	if (navigator.mediaDevices) {
		// access the web cam
		navigator.mediaDevices.getUserMedia({
				video: true
			})
			// permission granted:
			.then(function (stream) {
				var takeSnap = document.getElementById('snap-button');
				video.srcObject = stream;
				takeSnap.addEventListener('click', takeSnapshot);
			})
			// permission denied:
			.catch(function (error) {
				window.location = "/index.php/studio/error";
			});
	}
})();

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

var loadFile = function(event) {
	document.getElementById("stream").style.display = 'none';
    var output = document.getElementById('output');

	// display upload into base64;
	var files = document.getElementById('file').files;
  	if (files.length > 0) {
    	getBase64(files[0], output);
	  }
	
	var input = document.createElement('input');
	input.setAttribute('type', 'hidden');
	input.setAttribute('name', 'image');
	getBase64value(files[0], input);
	input.src.toDataURL;
	form.appendChild(input);
	form.style.display = "block";

	var submit = document.createElement('input');
	submit.setAttribute('type', 'submit');
	submit.setAttribute('value', 'Save image');
	submit.setAttribute('class', 'button is-info')
	form.appendChild(submit);

	document.getElementById('studio-btns').style.display = "none";
};