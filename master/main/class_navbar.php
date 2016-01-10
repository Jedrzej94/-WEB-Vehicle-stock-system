<?php

$menu = array(
  'home'  		=> array('text' => 'Home',  			'url' => '?p=home',			'pageaccesslvl' => '0'),
  'news'  		=> array('text' => 'News',  			'url' => '?p=news',			'pageaccesslvl' => '0'),
  'contact'  	=> array('text' => 'Contact',  			'url' => '?p=contact',		'pageaccesslvl' => '0'),
  'about' 		=> array('text' => 'About', 			'url' => '?p=about',		'pageaccesslvl' => '0'),
  'mainstock'	=> array('text' => 'Maintain stock',	'url' => '?p=mainstock',	'pageaccesslvl' => '1'),
);

$menu2 = array(
	'home'  		=> array('text' => 'Home',  			'url' => '?p=home',			'pageaccesslvl' => '0'),
	'addstock'  	=> array('text' => 'Add stock',  		'url' => '?p=addstock',		'pageaccesslvl' => '1'),
	'amendstock'  	=> array('text' => 'Amend stock',  		'url' => '?p=amendstock',	'pageaccesslvl' => '1'),
	'delstock'  	=> array('text' => 'Remove stock',  	'url' => '?p=delstock',		'pageaccesslvl' => '1'),
	'searchstock'  	=> array('text' => 'Search stock',  	'url' => '?p=searchstock',	'pageaccesslvl' => '1'),
	'printstock'  	=> array('text' => 'Print stock',  		'url' => '?p=printstock',	'pageaccesslvl' => '1'),
);

class class_UserNavigationMenu
{
	public static function GenerateMenu($items) 
	{	
		$user_uid = $_SESSION['user_session'];
		$result = $GLOBALS['MYSQL_HANDLE']->query("SELECT `accesslvl` FROM `users` WHERE uid = '".$user_uid."'");
		$row = $result->fetch_assoc();

		$html = "<nav class = 'navbar'>\n";
		foreach($items as $key => $item) 
		{
			$selected = (isset($_GET['p'])) && $_GET['p'] == $key ? 'selected' : null;
			
			if($item['pageaccesslvl'] > $row['accesslvl'])
			{
				continue;
			}
			
			else
			{
				$html .= "<a href = '{$item['url']}' class = '{$selected}' > {$item['text']}</a>\n";
			}
		}
		$html .= "</nav>\n";
		return $html;
	}
};
?>