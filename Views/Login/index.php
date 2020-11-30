<div class="wrapper-box">

    <div class="box">
        <h1 class="center title">Login</h1>
        <?php 
        if (isset($error)) {
            echo '<p class="error-msg center">' . $error . '</p><br />' . PHP_EOL;
        }
        ?>
            <form action="<?php echo WEBROOT . 'index.php/login'; ?>" method="post">
                <input type="text" class="input" name="pseudo" placeholder="Username" value="<?php if (isset($pseudo)) { echo $pseudo; } ?>" required>
                <br />
                <input type="password" class="input" name="password" placeholder="Password" value="<?php if (isset($password)) { echo $password; } ?>" required>
				<br />
				<p><a href="/index.php/user/forgot_password">I forgot my password</a></p>
				<br />
				<input class="button is-info" type="submit" value="Login">
				<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                <br />
			</form>

    </div>
    <div class="box">
        <p class="center">No account yet ? <a href="/index.php/Register">Register</a></p>
    </div>

</div>