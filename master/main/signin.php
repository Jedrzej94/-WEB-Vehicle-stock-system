<?php
	require_once 'config.php';

	if($user->IsUserLoggedIn() != "")
	{
		$user->redirect('home.php');
	}

	if(isset($_POST['btn-login']))
	{
		$uname = $_POST['inp_uname_umail'];
		$upass = $_POST['inp_password'];
		$umail = $_POST['inp_uname_umail'];

		$user->login($uname, $upass, $umail);
	}
?>

<head>
	<meta http-equiv = "Content-Type" content = "text/html; charset = utf-8"/>
	<title>Sign in</title>
	
	<link rel = "stylesheet" href = "style.css" type = "text/css"/>
</head>

<body>

	<div class = "container">
		<div class = "form-container">
			<form method = "post">
				<h2>Sign in</h2>
				<hr/>

				<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_uname_umail" placeholder = "username or email address" required /> </div>
				<div class = "form-group"> <input type = "password" class = "form-control" name = "inp_password" placeholder = "password" required /> </div>
				
				<hr/>
				
				<div class = "form-group"> <input type = "submit" name = "btn-login" value = "Sign in"/> </div>
				
				<br/>
				<label>Don't have an account yet? <a href = "signup.php">Sign up here!</a></label>
			</form>
		</div>
	</div>

</body>