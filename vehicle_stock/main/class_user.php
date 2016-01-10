<?php
class USER
{
    private $db;
 
    function __construct($MYSQL_HANDLE)
    {
		$this->db = $MYSQL_HANDLE;
    }
 
    public function register($uname, $upass, $umail, $ufname, $ulname)
    {
	   $upassEx = password_hash($upass, PASSWORD_DEFAULT);
	   $this->db->query("INSERT INTO `users` (`username`, `password`, `email`, `first_name`, `last_name`) VALUES ('".$uname."', '".$upassEx."', '".$umail."', '".$ufname."', '".$ulname."')");
	   
	   $this->redirect('index.php?p=home');
    }
 
	public function login($uname, $upass, $umail)
	{
		$result = $this->db->query("SELECT * FROM `users` WHERE `username` = '".$uname."' OR `email` = '".$umail."'");
		$row = $result->fetch_assoc();

		if(mysqli_num_rows($result) > 0)
		{
			if(password_verify($upass, $row['password']))
			{
				$_SESSION['user_session'] = $row['uid'];

				$this->redirect('index.php?p=home');
				return true;
			}

			else
			{
				echo("ERROR: Wrong details!");
				return false;
			}
		}
	}
 
	public function IsUserLoggedIn()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
 
	public function logout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>