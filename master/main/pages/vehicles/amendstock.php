<body>

	<?php
		
		if(isset($_GET['id']))
		{
			if(isset($_POST['btn-amendveh']))
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
			
				$vehicle->amendVehicle($numplate, $make, $model, $engine, $mileage, $year, $color, $bodytype, $doors, $fueltype, $geartype, $price);
			}
			
			$vehicle->printVehicles($_GET['id']);
			$result = $MYSQL_HANDLE->query("SELECT * FROM `vehicles` WHERE `numplate` = '".$_GET['id']."'");
			while($row = $result->fetch_assoc()) 
			{
				?>
				<div class = "container">
					<div class = "form-container">
						<form method = "post">
							<h2>Amend vehicle details</h2>
							<hr/>
							
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_numplate" 	placeholder = "Number plate" 	readonly = "readonly" value = "<?php echo $row['numplate']; ?>" > </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_make" 		placeholder = "Make" 			value = "<?php echo $row['make']; 	  ?>" required> </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_model" 		placeholder = "Model" 			value = "<?php echo $row['model']; 	  ?>" required> </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_engine" 		placeholder = "Engine" 			value = "<?php echo $row['engine'];   ?>" required> </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_mileage" 	placeholder = "Mileage" 		value = "<?php echo $row['mileage'];  ?>" required> </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_year" 		placeholder = "Year" 			value = "<?php echo $row['year']; 	  ?>" required> </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_color" 		placeholder = "Color" 			value = "<?php echo $row['color']; 	  ?>" required> </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_bodytype" 	placeholder = "Body type" 		value = "<?php echo $row['bodytype']; ?>" required> </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_doors" 		placeholder = "Doors" 			value = "<?php echo $row['doors']; 	  ?>" required> </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_fueltype" 	placeholder = "Fuel type" 		value = "<?php echo $row['fueltype']; ?>" required> </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_geartype" 	placeholder = "Gear type" 		value = "<?php echo $row['geartype']; ?>" required> </div>
								<div class = "form-group"> <input type = "text" class = "form-control" name = "inp_price" 		placeholder = "Price" 			value = "<?php echo $row['price'];    ?>" required> </div>
							
							<hr/>
								
							<div class = "form-group"> <input type = "submit" name = "btn-amendveh" value = "Amend"/> </div> </br>
							
						</form>
					</div>
				</div>
			<?php
			}
		}
		?>
</body>
</html>