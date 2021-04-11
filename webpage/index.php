<?php
include('connection.php');

$isFailedLogin = false; 
if($isPost && $action=='login') {
	$username = $_REQUEST['username'];
	$pwd = $_REQUEST['pwd'];

	if ($usersRepo->checkUser($username, $pwd)) {
		$_SESSION['user'] = $usersRepo->getUser($username);
		redirect('index.php');			
	} else {
		$isFailedLogin = true;
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>My Personal Page</title>
	<link href="style.css" type="text/css" rel="stylesheet" />
</head>

<body>
	<h1>My Blog</h1>
	<h4>In this web site you can leave any post you want.</h4>
	<hr />
	<!-- Show this part if user is not signed in yet -->
	<div class="twocols">
	<?php if (!isset($_SESSION['user'])): ?>
		<form action="index.php?action=login" method="post" class="twocols_col">
			<ul class="form">
			<?php if ($isFailedLogin): ?>
				<span class="error">Incorrect login or password.</span>
			<?php endif ?>
				<li>
					<label for="username">Username</label>
					<input type="text" name="username" id="username" />
				</li>
				<li>
					<label for="pwd">Password</label>
					<input type="password" name="pwd" id="pwd" />
				</li>
				<li>
					<label for="remember">Remember Me</label>
					<input type="checkbox" name="remember" id="remember" checked />
				</li>
				<li>
					<input type="submit" value="Submit" /> &nbsp; Not registered? <a href="register.php">Register</a>
				</li>
			</ul>
		</form>
		<?php endif ?>
		<div class="twocols_col">
			<h2>About Us</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
			Consectetur libero nostrum consequatur dolor. Nesciunt eos dolorem enim accusantium libero impedit ipsa 
			perspiciatis vel dolore reiciendis ratione quam, non sequi sit! Lorem ipsum dolor sit amet, consectetur 
			adipisicing elit. Optio nobis vero ullam quae. Repellendus dolores quis tenetur enim distinctio, optio vero, 
			cupiditate commodi eligendi similique laboriosam maxime corporis quasi labore!</p>
		</div>
	</div>

	<?php if (isset($_SESSION['user'])): ?>
	<!-- Show this part after user signed in successfully -->
	<div class="logout_panel">
		<a href="register.php">My Profile</a>&nbsp;|&nbsp;<a href="index.php?logout=1">Log Out</a>
	</div>
	<h2>New Post</h2>
	<form action="index.php" method="post">
		<ul class="form">
			<li>
				<label for="title">Title</label>
				<input type="text" name="title" id="title" />
			</li>
			<li>
				<label for="body">Body</label>
				<textarea name="body" id="body" cols="30" rows="10"></textarea>
			</li>
			<li>
				<input type="submit" value="Post" />
			</li>
		</ul>
	</form>
	<?php endif ?>

	<div class="onecol">
	<?php foreach ($postsRepo->getPosts() as $post): ?>
		<div class="card">
			<h2><?= $post['title'] ?></h2>
			<h5><?= $post['publishDate'] ?></h5>
			<p><?= $post['body'] ?></p>
		</div>
	<?php endforeach ?>
	</div>
</body>

</html>