<div class="wrapper-box">

	<div class="box">
		<h1 class="title center">Письмо с подтверждением.</h1>
		<?php if (isset($error)) : ?>
			<p class="error-msg center"><?php echo $error; ?></p>
		<?php endif; if (!isset($email_sended)) :?>
		<form method="post" action="/index.php/activation/resend">
			<input type="email" name="email" class="input" placeholder="Your email adress" required>
			<br />
			<input type="submit" class="button is-info">
		</form>
		<br />
		<?php else : ?>
		<p class="center"><?= $email_sended ?></p>
		<?php endif; ?>
	</div>

</div>