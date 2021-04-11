<?php  

include('connection.php');

$username = '';
$pwd = '';
$confirmPwd = '';
$fullname = '';
$email = '';

$usernamePattern='/^\w{4,}$/i';
$pwdPattern='/^\w{4,}$/i';
$fullnamePattern='/^[a-z]+( [a-z]+)*$/i';
$emailPattern='/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i';

$isValid = TRUE;
$isOk = TRUE;

if($isPost && $action == 'register') {
	$username=$_REQUEST["username"];
	$pwd =$_REQUEST["pwd"];
	$confirmPwd =$_REQUEST["confirmPwd"];
	$fullname = $_REQUEST["fullname"];
	$email = $_REQUEST["email"];
}

  
// if($isPost && $action == 'register') {
// 	$_SESSION['isAuth'] = false;
// 	redirect('index.php');
// }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
	<?= "isvalid: ".$isValid ?>
		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php?action=register" method="post">
			<ul class="form">
				<li>
					<label for="username">Username</label>
					<input type="text" name="username" id="username" value="<?= $username?>" required/>
					<?php if ($isPost && !preg_match($usernamePattern, $username)): $isValid=FALSE; ?>
					<span class="error">Required field.</span>
					<?php endif ?>
				</li>
				<li>
					<label for="fullname">Full Name</label>
					<input type="text" name="fullname" id="fullname" value="<?= $fullname?>" required/>
					<?php if ($isPost && !preg_match($fullnamePattern, $fullname)): $isValid=FALSE; ?>
					<span class="error">Required field.</span>
					<?php endif ?>
				</li>
				<li>
					<label for="email">Email</label>
					<input type="email" name="email" id="email" value="<?= $email?>" />
					<?php if ($isPost && !preg_match($emailPattern, $email)): $isValid=FALSE; ?>
					<span class="error">Required field.</span>
					<?php endif ?>
				</li>
				<li>
					<label for="pwd">Password</label>
					<input type="password" name="pwd" id="pwd" value="<?= $pwd?>" required/>
					<?php if ($isPost && !preg_match($pwdPattern, $pwd)): $isValid=FALSE; ?>
					<span class="error">Required field.</span>
					<?php endif ?>
				</li>
				<li>
					<label for="confirmPwd">Confirm Password</label>
					<input type="password" name="confirmPwd" id="confirmPwd" required />
					<?php if ($isPost && $pwd != $confirmPwd):  $isValid=FALSE; ?>
					<span class="error">Required field.</span>
					<?php endif ?>
				</li>
				<?php  
					echo "asdasdasd.".$isPost.":".$action.":".$isValid; 
					if($isPost && $action == 'register' && $isValid) {
						
						$isOk = $usersRepo->addUser($username, $pwd, $name, $email);
						if ($isOk) {
							$_SESSION['user'] = $usersRepo->getUser($username);
							redirect('index.php');
						}
					}
				?>
				<?php if (!$isOk): ?>
					<span class="error">This user exists in database!</span>
				<?php endif ?>
				<li>
					<input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
				</li>
			</ul>
		</form>
	</body>
</html>