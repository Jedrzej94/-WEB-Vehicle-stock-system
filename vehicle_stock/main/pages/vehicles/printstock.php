<body>

	<?php
	
		include_once '../../config.php';
		include_once '../../class_vehicle.php';
		$vehicle = new VEHICLE($MYSQL_HANDLE);
		$vehicle->printVehicles();
		
	?>
	
</body>
</html>