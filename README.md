# (WEB) Vehicle stock system
___________________________________
This is more advanced system that I had to develop as my assignment back in UK when I have lived there. It is a WEB vehicle system, which is including:

- Databases (accounts, vehicles).
- Programming rules such as: DRY.
- User login system, sign in & sign up using database (with password hashing).
- Basic maintain functions such as: add, amend, delete, view etc.
- Different permissions depending on the admin (user's) level.
- Folder creation & removing (with custom function to remove folders which contain data in it).
- Dynamic webpages (?=) AND Dynamic navigation bar creation (with two CSS styles to be chosen from).
- String processing.
- PHP procedures with PHP super-global variables.
- Security functions such as trim, strip etc.
- Objective programming.

**NOTE**:

Code that I have developed was ugly and done in a very horrible way, it was my beginning with PHP programming so I have decided to write whole system from scratch. PLEASE keep in mind, that I wasn't taught OOP in school and I had to learn it on my own. It was pretty much my own experience from C programming.

# To begin with...
___________________________________

First of all, you will need your database sorted, please download WAMP or LAMP server depending on your current operating system. You can find server downloads below.

- Windows server (WAMP): http://www.wampserver.com/en/#download-wrapper
- Linux server (LAMP): https://bitnami.com/stack/lamp/installer

Make sure that you run this SQL code first in order to create:

User table list:

```
CREATE TABLE IF NOT EXISTS `users` (
`uid` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(16) NOT NULL,
`password` varchar(64) NOT NULL,
`email` varchar(24) NOT NULL,
`first_name` varchar(12) NOT NULL,
`last_name` varchar(12) NOT NULL,
`accesslvl` tinyint(4) NOT NULL,
`status` tinyint(4) NOT NULL,
PRIMARY KEY (`uid`)
)
```

Vehicle table list:

```
CREATE TABLE IF NOT EXISTS `vehicles` (
`uid` int(11) NOT NULL AUTO_INCREMENT,
`numplate` varchar(12) NOT NULL,
`make` varchar(12) NOT NULL,
`model` varchar(12) NOT NULL,
`engine` float NOT NULL,
`mileage` float NOT NULL,
`year` smallint(6) NOT NULL,
`color` varchar(20) NOT NULL,
`bodytype` varchar(12) NOT NULL,
`doors` tinyint(4) NOT NULL,
`fueltype` varchar(12) NOT NULL,
`geartype` varchar(12) NOT NULL,
`price` mediumint(8) NOT NULL,
`description` text NOT NULL,
PRIMARY KEY (`uid`)
)
```

They are necessary in order to make the whole script work.

# System description
___________________________________

**DATABASE CONNECTION**

This part is pretty much self descriptive. It is holding our Database informations where we have to connect and it also is creating a new object USER with the session start. Which means user has logged in and is ready to surf the webiste.

https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/config.php

-
**SIGN IN - SIGN UP - SIGN OUT**

User object class: https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/class_user.php


*SIGN IN* (https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/signin.php)

First of all, in order to access the page you have to be logged in. So, if user will be redirected to the sign in webpage where user will be allowed to enter his username/e-mail address and password in order to log in. 
![SignIn](/master/images/signin.jpg)

```
public function login($uname, $upass, $umail)
{
  // Here's where we query our database with given information by user, which is username or email address.
	$result = $this->db->query("SELECT * FROM `users` WHERE `username` = '".$uname."' OR `email` = '".$umail."'");
	
	// Fetching associated fields in DB with the information given and storing data to the $row variable.
	$row = $result->fetch_assoc();
	
	// Checking if there are any rows found.
	if(mysqli_num_rows($result) > 0)
	{
	  // Veryfing user's password (using default function which is hashing user's input and comparing it to the password from the database field).
		if(password_verify($upass, $row['password']))
		{
		  // If password's are the same, we are creating a user's session with PHP's global variable (SESSION) with his primary key from the database, which is uid (unique identification number).
			$_SESSION['user_session'] = $row['uid'];
			
			// Rediricting 'this' object (user) to index page with the home tag.
			$this->redirect('index.php?p=home');
			return true;
		}
		
		// If user's given password is not the right now, he will not proceed and receive appropriate message.
		else
		{
			echo("ERROR: Wrong details!");
			return false;
		}
	}
}
```

-
*SIGN UP* (https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/signup.php)

If user doesn't have an account he's going to need one. In order to get to this webpage, user will have to press a referece text under sign in form and will get redirected to the signup webpage.
![SignUp](/master/images/signup.jpg)

```
public function register($uname, $upass, $umail, $ufname, $ulname)
{
  // First of all we gain all the data given by user's wish be reference from above. Variables in brackets are holding values insterted by user.
  
  // Hashing user's password to be stored and secured in the database.
  $upassEx = password_hash($upass, PASSWORD_DEFAULT);
  $this->db->query("INSERT INTO `users` (`username`, `password`, `email`, `first_name`, `last_name`) VALUES ('".$uname."', '".$upassEx."', '".$umail."', '".$ufname."', '".$ulname."')");
  
  // Redirecting user to the index page with home tag.
  $this->redirect('index.php?p=home');
}
```

NOT all the fields are necessary to be insterted when signing up, some of them can be left out blank and some of them are necessary.

This whole system is based on the SQL language, so all the accounts are automatically created in our database which was described at the very beginning of the whole ReadMe file. It is a dynamic user login and register system. Picture below is showing created users in database.
![userDB](/master/images/usersdb.jpg)

-
*SIGN OUT* (https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/logout.php)
```
<?php
	include_once 'config.php';
	
	// Check if our object (user) is logged in and if he has a parameter "logout" set to "true" in a URL bar. If so, proceed to the log out function and redirect them to the sign in page.
	if($user->IsUserLoggedIn() && $_GET['logout'] == true)
	{
		$user->logout(); // calling a function from the class_user.php to destroy user's session and unset his SUPER PHP's VARIABLE.
		$user->redirect('signin.php');
	}
?>
```

-
**HOME PAGE**

As soon as we get signed in, we are getting redirected to the main website, which is a home page. At home page we are given a FIXED navigation menu and a FIXED top bar which has some functions on the left and the right side. A good thing about fixed menu's is that whenever user's scrolling down the page, menu is always going to stick on the screen and it won't move anywhere from there. So it is easier for user to navigate through the website.

https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/index.php

* PHP
```
<?php

// First, code is trying to initialize a configuration and object (user) creation with object (navigation bar) as well.
include_once 'config.php';
include_once 'class_navbar.php';

// If user is not logged in, he will be redirected to the signin page. It is a security question, to do not let people change the webpages through the URL bars.
if(!$user->IsUserLoggedIn())
{
$user->redirect('signin.php');
}

// Fetching for the all data about user from the database.
$user_uid = $_SESSION['user_session'];
$result = $MYSQL_HANDLE->query("SELECT * FROM `users` WHERE uid = '".$user_uid."'");
$row = $result->fetch_assoc();
?>
```

Nav. bar object: https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/class_navbar.php
```
/* Default website's navigation menu which holds Home, News, Contact and About pages. Maintain stock webpage is only shown for user with certain access level. It can be clearly read from the array below. */

$menu = array(
  'home'  		=> array('text' => 'Home',  			'url' => '?p=home',			'pageaccesslvl' => '0'),
  'news'  		=> array('text' => 'News',  			'url' => '?p=news',			'pageaccesslvl' => '0'),
  'contact'  	=> array('text' => 'Contact',  			'url' => '?p=contact',		'pageaccesslvl' => '0'),
  'about' 		=> array('text' => 'About', 			'url' => '?p=about',		'pageaccesslvl' => '0'),
  'mainstock'	=> array('text' => 'Maintain stock',	'url' => '?p=mainstock',	'pageaccesslvl' => '1'), // Required access level: 1 (administrator of level 1).
);

class class_UserNavigationMenu
{
	public static function GenerateMenu($items) 
	{	
		// User's UID is necessary in order to provide SQL results for the website and query anything to the database.
		$user_uid = $_SESSION['user_session'];
		$result = $GLOBALS['MYSQL_HANDLE']->query("SELECT `accesslvl` FROM `users` WHERE uid = '".$user_uid."'"); // Another Super global PHP's variable $GLOBALS.
		$row = $result->fetch_assoc();
		$html = "<nav class = 'navbar'>\n";
		foreach($items as $key => $item) // Iterating through items of the navigation menu.
		{
			$selected = (isset($_GET['p'])) && $_GET['p'] == $key ? 'selected' : null; // Checking selected option. This line of code is called a conditional expression. It is a shorted way of if/else procedure.
			
			if($item['pageaccesslvl'] > $row['accesslvl']) // That's why we needed to access user's database, in order to check user's access level and make sure to show them Maintain stock option or any other navigation menu item which is available for them at certain level.
			{
				continue;
			}
			
			else
			{
				// Gluing together all the navigation menu parts.
				$html .= "<a href = '{$item['url']}' class = '{$selected}' > {$item['text']}</a>\n";
			}
		}
		$html .= "</nav>\n";
		return $html;
	}
};
```

* HTML
```
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset = utf-8" />
<link rel = "stylesheet" href = "style.css" type = "text/css" />
<title>Welcome - <?php print($row['email']); ?></title>

<!-- Creating our navigation bar with the reference to the '$menu' variable. -->
<?php echo class_UserNavigationMenu::GenerateMenu($menu); ?>

<!-- Creation of the top blue bar with two buttons on it with the reference to my github page and to log out from the session -->
<div class = "header">

	<div class = "left">  <label><a href = "https://github.com/Jedrzej94/">github.com</a></label> </div>
	<div class = "right"> <label><a href = "logout.php?logout=true">Logged in as <?php print($row['username']); ?> (sign out)</a></label> </div>
	
</div>
</head>

<body>

<!-- Opening the body tag and starting inserting the content of the index.php -->
<div class = "content">
	
<?php 

<!-- Checking if user has a 'p' tag in his URL bar, which stands from PAGE -->
	if(isset($_GET['p']))
	{
	<!-- It is allowing us to check which item user has chosen from the navigation menu and load appropriate file -->
		switch($_GET['p'])
		{
			case "home":		include("pages\index\home.php"); break;		<!-- Great thing about INCLUDING PHP file instead of redirecting user to the file is described below. -->
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
```

File including is a great feature if you don't want your page to be reloaded and just want to keep your files nice and clean. What I mean by that, here we have a **DRY** programming rule which stands for **Don't Repeat Yourself**. A great thing about that is we don't have to create the navigation bar for each webpage anymore, we can just simply do:

```
<body>

	<div class = "content">
	
		<h1>Home page</h1>
		 
	</div>
	
</body>
</html>
```
https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/pages/index/home.php

for each of our webpages. Image below to show how it looks like in action:
![SignUp](/master/images/home.jpg)

-
**STOCK MAINTENANCE**

Stock maintenance is a Administration feature that is allowing him to either Add, change, delete and do other things to the vehicle's database at the website. 

https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/pages/vehicles/mainstock.php

This file has pretty much the same code as index.php, it had to be done again because of the administrator privileges and the second navigation menu.

-
**ADD - AMEND - DELETE - SEARCH - PRINT**

* *ADD* (https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/pages/vehicles/addstock.php)
Adding a new stock to the database is very important, this kind of vehicle stock system could be used as reference to the real website like autotrader, where people sell their vehicles etc. Administrator has an option to add a vehicle.

PHP:
```
<?php
	if(isset($_POST['btn-addveh']))
	{
		// This part of the PHP code is called only when user has pressed "Add" button with the vehicle details in.
		// It is trimming user's input from all the html tags etc. to avoid them calling code from their side.
		$numplate 	= trim($_POST['inp_numplate']);
		$make 		= trim($_POST['inp_make']);
		$model 		= trim($_POST['inp_model']);
		$engine 	= trim($_POST['inp_engine']);
		$mileage	= trim($_POST['inp_mileage']);
		$year		= trim($_POST['inp_year']);
		$color		= trim($_POST['inp_color']);
		$bodytype	= trim($_POST['inp_bodytype']);
		$doors		= trim($_POST['inp_doors']);
		$fueltype	= trim($_POST['inp_fueltype']);
		$geartype	= trim($_POST['inp_geartype']);
		$price		= trim($_POST['inp_price']);
		
		// Including vehicle's class. '../../' means we are backing up to the parent directory (master dir).
		include_once '../../class_vehicle.php';
		$vehicle = new VEHICLE($MYSQL_HANDLE); // Creating a new CLASS object and storing it into $vehicle variable.
		
		// Asking database to get number plate of the vehicle and store the results into $result variable.
		$result = $MYSQL_HANDLE->query("SELECT `numplate` FROM `vehicles` WHERE `numplate` = '".$numplate."'");
		$row = $result->fetch_assoc();
		if($row['numplate'] == $numplate) 
		{
			echo("ERROR: That vehicle has been registered before!");
		}
		
		else
		{
			// If vehicle's registration number (number plate) hasn't been found in the database, we are calling a addVehicle function with the reference parameters for the class object created before ($vehicle).
			$vehicle->addVehicle($numplate, $make, $model, $engine, $mileage, $year, $color, $bodytype, $doors, $fueltype, $geartype, $price);
		}
	}
?>
```

class function:
```
public function addVehicle($numplate, $make, $model, $engine, $mileage, $year, $color, $bodytype, $doors, $fueltype, $geartype, $price)
{
	// First we are converting user's number plate input into UPPER CASE text.
	$numplateEx = strtoupper($numplate);
	
	// And we store this object ($vehicle) into our database field with data given by user. Data was passed by reference, where the function was called.
	$this->db->query("INSERT INTO `vehicles` (`numplate`, `make`, `model`, `engine`, `mileage`, `year`, `color`, `bodytype`, `doors`, `fueltype`, `geartype`, `price`) VALUES ('".$numplateEx."', '".$make."', '".$model."', '".$engine."', '".$mileage."', '".$year."', '".$color."', '".$bodytype."', '".$doors."', '".$fueltype."', '".$geartype."', '".$price."')");
	
	// Checking if directory with the number plate exists in the 'images' folder.
	if(!is_dir("images/$numplateEx"))
	{
		mkdir("images/$numplateEx");
	}
	
	// This is where the images of the vehicle are stored and loaded by the different class functions such as print/search etc.
	$upload_dir = "images/$numplateEx/";
	
	// Checking multiple images loaded by user to be uploaded to the server.
	foreach($_FILES['inp_image']['name'] as $name => $value)
	{
		$filename = stripslashes($_FILES['inp_image']['name'][$name]);
		$extension = getExtension($filename);
		$extension = strtolower($extension);
		
		// Extension security check, if it's different than one of the below extensions we can make user stop there and force program to quit.
		if(($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
		{
		}
		
		else
		{
			$size = filesize($_FILES['inp_image']['tmp_name'][$name]);
		}
		
		// Copying file(s) to the folder.
		$image_name = $filename.'.'.$extension;
		$newname = $upload_dir.$image_name;
		$copied = copy($_FILES['inp_image']['tmp_name'][$name], $newname);
		
		// Checking if there were any problems regarding file(s) upload. We can send message or anything we wanna do if files weren't uploaded below.
		if (!$copied) 
		{
			
		}
	}
}
```

HTML:
--- pretty much self-explanatory here, a simple form to be shown user to enter details about vehicle.
![SignUp](/master/images/addstock.jpg)


* *AMEND* 
(https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/pages/vehicles/amendstock.php)

Amend code is using pretty much the same code as ADD but with only difference that we are reading data from database and INSERTING it into fields for user to be changed. First of all, when we are trying to call Amend code, first we are being prompted by script to enter vehicle's number plate (registration number). If we don't know it, we can simply use a PRINT item from the navigation menu.

Please check this code for the SEARCH code:
https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/pages/vehicles/searchstock.php

Most of the code is based on the SEARCH functions.

* *PRINT*
https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/pages/vehicles/printstock.php

This code is simply calling a function in the VEHICLE class called "printVehicles();"

```
<body>

	<?php
	
		include_once '../../config.php';
		include_once '../../class_vehicle.php';
		$vehicle = new VEHICLE($MYSQL_HANDLE);
		$vehicle->printVehicles();
		
	?>
	
</body>
</html>
```
![print](/master/images/printstock.jpg)


Please check code's itself for more description about the code.
