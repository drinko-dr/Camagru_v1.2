<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Camagru</title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <link rel="stylesheet" type="text/css" href="/Assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/Assets/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>

<div id="container">
<nav class="navbar" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<a class="navbar-item is-size-4" href="/">Camagru</a>
	</div>


    <div class="navbar-end" style="float:right;margin-right:20px;">
      <div class="navbar-item">
        <div class="buttons">
			<?php if (isset($_SESSION['id'])) : ?>
				<a href="/index.php/studio"><i class="fas is-size-4 fa-video"></i></a>
				<a href="/index.php/notification"><i class="far is-size-4 fa-heart"></i></a>
				<a href="/index.php/profile/"><i class="far is-size-4 fa-user-circle"></i></a>
			<?php else :?>
				<a class="button is-dark" href="/index.php/register"><strong>Sign up</strong></a>
	          	<a class="button is-light" href="/index.php/login">Log in</a>
			<?php endif; ?>
        </div>
      </div>
    </div>
</nav>

<main>