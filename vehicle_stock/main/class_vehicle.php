<?php
class VEHICLE
{
    private $db;
 
    function __construct($MYSQL_HANDLE)
    {
      $this->db = $MYSQL_HANDLE;
    }
	
	public function addVehicle($numplate, $make, $model, $engine, $mileage, $year, $color, $bodytype, $doors, $fueltype, $geartype, $price)
	{
		$numplateEx = strtoupper($numplate);
		$this->db->query("INSERT INTO `vehicles` (`numplate`, `make`, `model`, `engine`, `mileage`, `year`, `color`, `bodytype`, `doors`, `fueltype`, `geartype`, `price`) VALUES ('".$numplateEx."', '".$make."', '".$model."', '".$engine."', '".$mileage."', '".$year."', '".$color."', '".$bodytype."', '".$doors."', '".$fueltype."', '".$geartype."', '".$price."')");
		
		if(!is_dir("images/$numplateEx"))
		{
			mkdir("images/$numplateEx");
		}
		
		$upload_dir = "images/$numplateEx/";
		
		foreach($_FILES['inp_image']['name'] as $name => $value)
		{
			$filename = stripslashes($_FILES['inp_image']['name'][$name]);

			$extension = getExtension($filename);
			$extension = strtolower($extension);
			
			if(($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
			{

			}
			
			else
			{
				$size = filesize($_FILES['inp_image']['tmp_name'][$name]);
			}
			
			$image_name = $filename.'.'.$extension;
			$newname = $upload_dir.$image_name;
			$copied = copy($_FILES['inp_image']['tmp_name'][$name], $newname);
			if (!$copied) 
			{
				
			}
		}
	}
	
	public function amendVehicle($numplate, $make, $model, $engine, $mileage, $year, $color, $bodytype, $doors, $fueltype, $geartype, $price)
	{
		$numplateEx = strtoupper($numplate);
		$this->db->query("UPDATE `vehicles` SET `make` = '".$make."', `model` = '".$model."', `engine` = '".$engine."', `mileage` = '".$mileage."', `year` = '".$year."', `color` = '".$color."', `bodytype` = '".$bodytype."', `doors` = '".$doors."', `fueltype` = '".$fueltype."', `geartype` = '".$geartype."', `price` = '".$price."' WHERE `numplate` = '".$numplateEx."'");
	}
	
	public function deleteVehicle($numplate)
	{
		$numplateEx = strtoupper($numplate);
		rrmdir("pages/vehicles/images/$numplateEx");
		$this->db->query("DELETE FROM `vehicles` WHERE `numplate` = '".$numplateEx."'");
	}

    public function printVehicles($seeknumplate = null)
    {
		if($seeknumplate == null)
		{
			$result = $this->db->query("SELECT * FROM `vehicles`");
		}
		
		else
		{
			$result = $this->db->query("SELECT * FROM `vehicles` WHERE `numplate` = '".$seeknumplate."'");
		}

		?>
		<style>
		
		.contentEx
		{
			margin-top:2%;
			margin-left:10%;
			padding:1px 16px; 
			font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
		}

		.imagesize
		{
			width: 250px;
			height: 150px;
		}

		</style>
			
		<?php
		
		while($row = $result->fetch_assoc()) 
		{
			$directory = "images/".$row['numplate'];
			$images = glob($directory."/*.jpg");
			?>
			
			<div class = "contentEx">
		
				<a href = "searchstock.php?id=<?php echo $row['numplate']; ?>"><h3><?php echo $row['make'] . ' ' . $row['model']; ?></h3></a>
				
				<?php
				foreach($images as $image)
				{
				?>
					<img class = "imagesize" src = "<?php echo $image; ?>" />
				<?php
				}
				?>
			
			</div>
		
			<?php
		}
    }
}

function getExtension($string)
{
	$i = strrpos($string, ".");
	if(!$i) 
	{ 
		return ""; 
	}
	
	$length = strlen($string) - $i;
	$ext = substr($string, $i + 1, $length);
	return $ext;
}

function rrmdir($dirpath) 
{ 
	if(is_dir($dirpath)) 
	{ 
		$objects = scandir($dirpath); 
		foreach($objects as $object) 
		{ 
			if($object != "." && $object != "..") 
			{ 
				if(is_dir($dirpath."/".$object))
					rrmdir($dirpath."/".$object);
				else
					unlink($dirpath."/".$object); 
			}
		}
		rmdir($dirpath); 
	} 
}
?>