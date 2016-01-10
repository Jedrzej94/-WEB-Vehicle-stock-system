<?php
	include_once '../../config.php';
	include_once '../../class_navbar.php';
	include_once '../../class_vehicle.php';
	
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
	
	
	<div class = "header">
	
		<div class = "left">  <label><a href = "https://github.com/Jedrzej94/">github.com</a></label> </div>
		<div class = "right"> <label><a href = "logout.php?logout=true">Logged in as <?php print($row['username']); ?> (sign out)</a></label> </div>
		
	</div>
</head>

<body>
	
	<div class = "content">
		
		<?php 
		
			$vehicle = new VEHICLE($MYSQL_HANDLE);
			
			if(!isset($_GET['id']))
			{
				if(isset($_POST['btn-searchveh']))
				{
					$numplate = trim($_POST['inp_numplate']);
					$vehicle->printVehicles($numplate);
					
					if(isset($_GET['p']))
					{
						if($_GET['p'] == "delstock")
						{
							$vehicle->deleteVehicle($numplate);
						}
					}
				}
				?>
				
				<div class = "container">
					<div class = "form-container">
						<form method = "post">
							<h2>Search</h2>
							<hr/>
							
							<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_numplate" placeholder = "Number plate" value = "<?php if(isset($numplate)) { echo $numplate; } ?>" required> </div>
							
							<hr/>
								
							<div class = "form-group"> <input type = "submit" name = "btn-searchveh" value = "Search"/> </div>
							
						</form>
					</div>
				</div>
				<?php
			}
			
			else
			{
				include_once("amendstock.php");
			}
		
			if(isset($_GET['p']))
			{
				switch($_GET['p'])
				{
					case "home":		header("Location: ../../index.php"); break;
					case "addstock":	include("addstock.php"); break;
					case "amendstock":	include("searchstock.php"); break;
					case "delstock":	include("searchstock.php"); break;
					case "searchstock":	require_once("searchstock.php"); break;
					case "printstock":	require_once("printstock.php"); break;
					
					default:			header("Location: ../../index.php"); break;
				}
			}
		
		 ?>
		
	</div>
</body>
</html>