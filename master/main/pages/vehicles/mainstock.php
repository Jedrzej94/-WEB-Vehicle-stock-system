<?php
	include_once '../../config.php';
	include_once '../../class_navbar.php';
	
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
	<link rel = "stylesheet" href = "../../style.css" type = "text/css" />
	<title>Welcome - <?php print($row['email']); ?></title>
	
	<?php echo class_UserNavigationMenu::GenerateMenu($menu2); ?>
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
					case "home":		header("Location: ../../index.php"); break;
					case "addstock":	include("addstock.php"); break;
					case "amendstock":	header("Location: searchstock.php"); break;
					case "delstock":	header("Location: searchstock.php"); break;
					case "searchstock":	header("Location: searchstock.php"); break;
					case "printstock":	include("printstock.php"); break;
					
					default:			header("Location: ../../index.php"); break;
				}
			}
		
		 ?>
		
	</div>
</body>
</html>