<?php
	require_once 'config.php';

	if($user->IsUserLoggedIn() != "")
	{
		$user->redirect('home.php');
	}

	if(isset($_POST['btn-signup']))
	{
		$fname = trim($_POST['inp_fname']);
		$lname = trim($_POST['inp_lname']);
		$uname = trim($_POST['inp_uname']);
		$upass = trim($_POST['inp_upass']); 
		$umail = trim($_POST['inp_umail']);

		if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) 
		{
			echo("ERROR: Please enter valid E-Mail address!");
		}

		if(strlen($upass) < 6)
		{
			echo("ERROR: Password must be at least 6 characters long!");
		}
		
		else
		{
			$result = $MYSQL_HANDLE->query("SELECT `username`, `email` FROM `users` WHERE `username` = '".$uname."' OR `email` = '".$umail."'");
			$row = $result->fetch_assoc();

			if($row['username'] == $uname || $row['email'] == $umail) 
			{
				echo("ERROR: That account has been created before!");
			}
			
			else
			{
				$user->register($uname, $upass, $umail, $fname, $lname);
			}
		}
	}
?>

<head>
	<meta http-equiv = "Content-Type" content = "text/html; charset = utf-8"/>
	<title>Sign up</title>
	<link rel = "stylesheet" href = "style.css" type = "text/css"/>
</head>

<body>
	<div class = "container">
		<div class = "form-container">
			<form method = "post">
				<h2>Sign up</h2>
				<hr/>
				
				<div class = "form-group"> <input type = "text" 	class = "form-control" name = "inp_fname" placeholder = "first name" value = "<?php if(isset($fname)) { echo $fname; } ?>" > </div>
				<div class = "form-group"> <input type = "text" 	class = "form-control" name = "inp_lname" placeholder = "last name" value = "<?php if(isset($lname)) { echo $lname; } ?>" > </div>
				<div class = "form-group"> <input type = "text" 	class = "form-control" name = "inp_uname" placeholder = "username" value = "<?php if(isset($uname)) { echo $uname; } ?>" required> </div>
				<div class = "form-group"> <input type = "password" class = "form-control" name = "inp_upass" placeholder = "password" required /> </div>
				<div class = "form-group"> <input type = "text" 	class = "form-control" name = "inp_umail" placeholder = "email address" value = "<?php if(isset($umail)) { echo $umail; } ?>" required> </div>

				<hr/>
					
				<div class = "form-group"> <input type = "submit" name = "btn-signup" value = "Sign up"/> </div>

				<br/>
				
				<label>Already a member? <a href = "signin.php">Sign In!</a></label>
			</form>
		</div>
	</div>
</body>
</html>