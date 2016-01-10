<?php
	include_once 'config.php';
	include_once 'class_navbar.php';
	
	if(!$user->IsUserLoggedIn())
	{
		$user->redirect('signin.php');
	}
	
	$user_uid = $_SESSION['user_session'];
	$result = $MYSQL_HANDLE->query("SELECT * FROM `users` WHERE uid = '".$user_uid."'");
	$row = $result->fetch_assoc();
?>

<head>
	<meta http-equiv = "Content-Type" content = "text/html; charset = utf-8" />
	<link rel = "stylesheet" href = "style.css" type = "text/css" />
	<title>Welcome - <?php print($row['email']); ?></title>
	
	<?php echo class_UserNavigationMenu::GenerateMenu($menu); ?>
	<div class = "header">
	
		<div class = "left">  <label><a href = "https://github.com/Jedrzej94/">github.com</a></label> </div>
		<div class = "right"> <label><a href = "logout.php?logout=true">Logged in as <?php print($row['username']); ?> (sign out)</a></label> </div>
		
	</div>
</head>

<body>
	<div class = "content">
		
		<?php 
		
			if(isset($_GET['p']))
			{
				switch($_GET['p'])
				{
					case "home":		include("pages\index\home.php"); break;
					case "news":		include("pages\index\\news.php"); break;
					case "contact":		include("pages\index\contact.php"); break;
					case "about":		include("pages\index\about.php"); break;
					case "mainstock":	header("Location: pages\\vehicles\mainstock.php"); break;
					
					default:			include("index.php"); break;
				}
			}
		
		 ?>
		
	</div>
</body>
</html>