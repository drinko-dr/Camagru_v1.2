<?php

if (!isset($_SESSION['pseudo'])) {
    $url = 'Location: ' . WEBROOT;
    header($url);
}
?>

<div class="wrapper-box">

    <div class="box">
        <h1 class="center title">Edit profile</h1>
        <br />
        <p class="success-msg center">Profil updated successfully.</p>
    </div>
    <div class="box">
        <p class="center"><a href="/index.php/profile/">Return</a></p>
    </div>

</div>