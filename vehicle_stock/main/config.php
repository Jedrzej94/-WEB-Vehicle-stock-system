<?php

	session_start();

	$MYSQL_HOST = "localhost";
	$MYSQL_USER = "root";
	$MYSQL_PASS = "";
	$MYSQL_DATA = "vehicle_stock";

	$MYSQL_HANDLE = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS, $MYSQL_DATA);

	include_once 'class_user.php';
	$user = new USER($MYSQL_HANDLE);

?>