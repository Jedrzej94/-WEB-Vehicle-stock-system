# (WEB) Vehicle stock system
___________________________________
This is more advanced system that I had to develop as my assignment back in UK when I have lived there. It is a WEB vehicle system, which is including:

- Databases (accounts, vehicles).
- User login system, sign in & sign up using database (with password hashing).
- Basic maintain functions such as: add, amend, delete, view etc.
- Different permissions depending on the admin (user's) level.
- Folder creation & removing (with functionality to remove folders which contain data in it).
- Dynamic navigation bar creation (with two CSS styles to be chosen).
- String processing.
- PHP procedures with PHP super-global variables.
- Security functions such as trim, strip etc.
- Objective programming.

# Database
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

# Description
___________________________________

**DATABASE CONNECTION**
This part is pretty much self descriptive. It is holding our Database informations where we have to connect and it also is creating a new object USER with the session start. Which means user has logged in and is ready to surf the webiste.

https://github.com/Jedrzej94/-WEB-Vehicle-stock-system/blob/master/master/main/config.php

**SIGN IN & SIGN UP**

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





