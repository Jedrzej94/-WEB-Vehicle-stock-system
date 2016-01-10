<body>

	<?php

		if(isset($_POST['btn-addveh']))
		{
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
			
			include_once '../../class_vehicle.php';
			$vehicle = new VEHICLE($MYSQL_HANDLE);
			
			$result = $MYSQL_HANDLE->query("SELECT `numplate` FROM `vehicles` WHERE `numplate` = '".$numplate."'");
			$row = $result->fetch_assoc();

			if($row['numplate'] == $numplate) 
			{
				echo("ERROR: That vehicle has been registered before!");
			}
			
			else
			{
				$vehicle->addVehicle($numplate, $make, $model, $engine, $mileage, $year, $color, $bodytype, $doors, $fueltype, $geartype, $price);
			}
		}
	?>
	
	<div class = "container">
		<div class = "form-container">
			<form method = "post" enctype = "multipart/form-data">
				<h2>Register new vehicle</h2>
				<hr/>
				
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_numplate" 	placeholder = "Number plate" 	value = "<?php if(isset($numplate)) { echo $numplate; 	} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_make" 		placeholder = "Make" 			value = "<?php if(isset($make)) 	{ echo $make; 		} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_model" 		placeholder = "Model" 			value = "<?php if(isset($model)) 	{ echo $model; 		} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_engine" 		placeholder = "Engine" 			value = "<?php if(isset($engine)) 	{ echo $engine; 	} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_mileage" 	placeholder = "Mileage" 		value = "<?php if(isset($mileage)) 	{ echo $mileage; 	} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_year" 		placeholder = "Year" 			value = "<?php if(isset($year)) 	{ echo $year; 		} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_color" 		placeholder = "Color" 			value = "<?php if(isset($color)) 	{ echo $color; 		} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_bodytype" 	placeholder = "Body type" 		value = "<?php if(isset($bodytype)) { echo $bodytype; 	} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_doors" 		placeholder = "Doors" 			value = "<?php if(isset($doors)) 	{ echo $doors; 		} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_fueltype" 	placeholder = "Fuel type" 		value = "<?php if(isset($fueltype)) { echo $fueltype; 	} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_geartype" 	placeholder = "Gear type" 		value = "<?php if(isset($geartype)) { echo $geartype; 	} ?>" required> </div>
					<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_price" 		placeholder = "Price" 			value = "<?php if(isset($price)) 	{ echo $price; 		} ?>" required> </div>
					<div class = "form-group"> <input type = "file" class = "form-control" name = "inp_image[]" 	multiple = "true" required> </div>
					
				<hr/>
					
				<div class = "form-group"> <input type = "submit" name = "btn-addveh" value = "Register"/> </div>
				
			</form>
		</div>
	</div>
	
</body>
</html>