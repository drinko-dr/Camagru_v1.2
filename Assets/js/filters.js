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

function upload_filter() {
	var files = document.getElementById("filter_upload").files;
	if (files.length > 0) {
		var input = document.createElement('input');
		input.setAttribute('type', 'hidden');
		input.setAttribute('name', 'image');

		getBase64value(files[0], input);

		input.src.toDataURL;
		document.getElementById("form2").appendChild(input);
	}
}