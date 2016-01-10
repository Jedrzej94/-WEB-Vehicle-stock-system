<?php
	include_once 'config.php';
	
	if($user->IsUserLoggedIn() && $_GET['logout'] == true)
	{
		$user->logout();
		$user->redirect('signin.php');
	}
?>