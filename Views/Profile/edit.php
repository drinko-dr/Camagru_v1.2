<div class="wrapper-box">

    <div class="box">
		<br />
        <h1 class="center title">Edit profile</h1>
        <br />
        <?php 
            if (isset($error))
            {
                echo '<p class="error-msg center">' . $error . '</p><br />';
            }
        ?>
        <form action="<?php echo WEBROOT . 'index.php/Profile/edit_form'; ?>" method="post">
            <input class="input" type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['email']; ?>">
            <br />
            <input type="text" class="input" name="pseudo" placeholder="Username" value="<?php echo $_SESSION['pseudo']; ?>">
            <br />
            <input type="password" class="input" name="old_password" placeholder="Old password">
            <br />
            <input type="password" class="input" name="new_password" placeholder="New password">
            <br />
            <input type="password" class="input" name="password_confirm" placeholder="Password confirmation">
            <br />
            <input type="checkbox" class="checkbox" name="notifications" <?php echo $_SESSION['notification_mails'] == 0 ? "" : "checked"; ?>>
            <label for="notifications">Receive notifications emails</label>
            <br />
            <br />
            <input class="button is-info" type="submit" value="Save changes">
            <br />
        </form>
    </div>
    <div class="box">
        <p class="center">Forgot your password?<br /> <a href="/index.php/user/forgot_password">Reset password</a></p>
    </div>
</div>