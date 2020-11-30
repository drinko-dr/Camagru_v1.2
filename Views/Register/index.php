<div class="wrapper-box">

    <div class="box">
        <h1 class="center title">Register</h1>
        <br />
        <?php
if (isset($error)) {
    echo '<p class="error-msg center">' . $error . '</p><br />';
}
?>
        <form action="<?php echo WEBROOT . 'index.php/Register'; ?>" method="post">
            <input class="input" type="email" name="email" placeholder="Email" value="<?php if (isset($email)) {echo $email;} ?>"required>
            <br />
            <input type="text" class="input" name="pseudo" placeholder="Username" value="<?php if (isset($pseudo)) {echo $pseudo;} ?>" required>
            <br />
            <input type="password" class="input" name="password" placeholder="Password" value="<?php if (isset($password)) {echo $password;} ?>" required>
            <br />
            <input type="password" class="input" name="password_confirm" placeholder="Password confirmation" value="<?php if (isset($password_confirm)) {echo $password_confirm;} ?>"required>
            <br />
			<input class="button is-info" type="submit" value="Register">
			<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <br />
        </form>
    </div>
    <div class="box">
        <p class="center">Already have an account ? <a href="/index.php/login">Log-in</a></p>
    </div>

</div>
