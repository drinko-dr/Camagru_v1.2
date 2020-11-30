<div class="wrapper-box">

<div class="box">
	<h1 class="title center">An error occured</h1> <br />
	<?php 
        if (isset($error)) {
            echo '<p class="error-msg center">' . $error . '</p><br />' . PHP_EOL;
        }
        ?>
	<p class="error-msg center">
		There is a problem with either your camera, your uploaded image or your request. <br />
		Please verify your image is valid and try again.
	</p><br /><br />

	<div class="center" style="width:50%;margin:0 auto;">
		<a class='button is-info' href="/index.php/studio">Try again</a>
	</div>

</div>

</div>
