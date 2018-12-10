<?php


	$servername = "localhost";
	$username = "kongat";
	$password = "123456789";
	$dbname = "digitalup_task";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$stmt = $conn->prepare("SELECT * FROM exercise WHERE email =?");
	$stmt->bind_param("s",$email);
	$email = $_POST["userEmail"];
	$stmt->execute();
	$result = $stmt->get_result();
	
	if (mysqli_num_rows($result) > 0) {
		
		echo 'true';
	}else{
		
		echo 'false';
	}
	mysqli_close($conn);

?>