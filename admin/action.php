<?php
// Include the database connection file
include('db_config.php');

if (isset($_POST['productId']) && !empty($_POST['productId'])) {

	// Fetch state name base on country id
	$query = "SELECT * FROM services WHERE pid = ".$_POST['productId'];
	$result = $con->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select Service</option>'; 
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['id'].'">'.$row['sname'].'</option>'; 
		}
	} else {
		echo '<option value="">Service not available</option>'; 
	}
} elseif(isset($_POST['serviceId']) && !empty($_POST['serviceId'])) {

	// Fetch city name base on state id
	$query = "SELECT * FROM services WHERE services.id = ".$_POST['serviceId'];
	$result = $con->query($query);

	if ($result->num_rows > 0) {
		//echo '<option value="">Select Price</option>'; 
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['price'].'">'.$row['price'].'</option>'; 
		}
	} else {
		echo '<option value="">Price not available</option>'; 
	}
}
?>