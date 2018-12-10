<?php
	session_start();
	
	$servername = "localhost";
	$username = "kongat";
	$password = "123456789";
	$dbname = "digitalup_task";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$stmt = $conn->prepare("SELECT * FROM exercise WHERE email =?");
	$stmt->bind_param("s",$email);
	$email = $_SESSION['user_email'];
	$stmt->execute();
	$result = $stmt->get_result();

	$row = $result->fetch_assoc();
	$username = $row['name'];
	$useremail = $row['email'];
	
	if(!isset($_SESSION['user_email'])){
      header("location:login.php");
   }
   
 
?>