<!DOCTYPE html>
<html lang="en">
<head>
  <title>DigitalUp Task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="./css/DUstyle.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
	// define variables and set to empty values
	$fullNameErr = $userEmailErr = $password1Err = $password2Err = $hashed_password = $success="";
	$fullName = $userEmail = $password1 = $password2 = "";
    $errors = 0;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
	  if (empty($_POST["fullName"])) {
		$fullNameErr = "Δεν έχετε συμπληρώσει το Ονοματεπώνυμο σας!";
		$errors++;
	  } else {
		$fullName = test_input($_POST["fullName"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$fullName)) {
			$errors++;
			$fullNameErr = "Επιτρέπονται μόνο γράμματα και κενά!"; 
		}
	  }
	  
	  if (empty($_POST["userEmail"])) {
		$userEmailErr = "Δεν έχετε συμπληρώσει το Email σας!";
		$errors++;
	  } else {
		$userEmail = test_input($_POST["userEmail"]);
		
		if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
			$userEmailErr = "Δεν έχετε εισάγει έγκυρο email!";
			$errors++;
		}
	  }
		
	  if (empty($_POST["password1"])) {
		$password1Err = "Δεν έχετε συμπληρώσει κωδικό πρόσβασης!";
		$errors++;
	  } else {
		$password1 = test_input($_POST["password1"]);
	  }

	  if (empty($_POST["password2"])) {
		$password2Err = "Πρέπει να εισάγεται 2 φορές τον κωδικό πρόσβασης για επαλήθευση";
		$errors++;
	  } else {
		$password2 = test_input($_POST["password2"]);
	  }
	  
	  if ($password1 === $password2){
		  $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
	  }else {
		  $password1Err = "Οι κωδικοί που είσάγατε δεν συμπίπτουν!";
		  $errors++;
	  }
	  
	  //Database connection and insert of the data
	  if ($errors == 0){
		  

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
		
		//check if the email already exists
		$stmt = $conn->prepare("SELECT * FROM exercise WHERE email =?");
		$stmt->bind_param("s",$email);
		$email = $userEmail;
		$stmt->execute();
		$result = $stmt->get_result();
		
		if (mysqli_num_rows($result) > 0) {
			$userEmailErr = "Το email χρησιμοποιείται ήδη.";
			mysqli_close($conn);
		}else{


			$sql = "INSERT INTO exercise (name, email, hashed_password)
			VALUES ('".$fullName."', '".$userEmail."', '".$hashed_password."')";

			if (mysqli_query($conn, $sql)) {
				$success="Η εγγραφή σας στο σύστημα ολοκληρώθηκε";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

			mysqli_close($conn);
			
			
		}
	  }
		
		  
	  
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>
	
		<nav class="navbar navbar-default center" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="#">Αρχική</a></li>
					<li><a href="#">Υπηρεσίες</a></li>
					<li><a href="#">Προφίλ</a></li>
					<li><a href="#">Προιόντα</a></li>
					<li><a href="#">Επικοινωνία</a></li>
				</ul>
			</div>
		</nav>
		<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 col-xs-4 col-xs-offset-4">
				<p class="lower">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean commodo neque sit amet consectetur rutrum.
					Etiam eros augue, tincidunt eget ex a, faucibus hendrerit dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
					Pellentesque consectetur lacinia ex ac finibus. 
				</p>
				<h4 class="text-center lower">Δημιουργήστε έναν λογαριασμό!</h4>
				
				<form id="form1" name="myForm" method="POST"  onsubmit="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
					
					    <span class="error" id="name-error"> <?php echo $fullNameErr;?></span>	
						<input id="fullName" class="" name="fullName" type="text" placeholder ="Ονοματεπώνυμο" onfocus="this.placeholder =''"onblur="this.placeholder ='Ονοματεπώνυμο'">	
						<span class="error" id="email-error"> <?php echo $userEmailErr;?></span>							
						<input id="userEmail" class="" name="userEmail" type="email" placeholder ="Email" onfocus="this.placeholder =''"onblur="this.placeholder ='Email'">
						<span class="error" id="password1-error"> <?php echo $password1Err;?></span>							
						<input id="password1" class="" name="password1" type="password" placeholder ="Κωδικός Πρόσβασης" onfocus="this.placeholder =''"onblur="this.placeholder ='Κωδικός Πρόσβασης'">	
					    <span class="error" id ="password2-error"> <?php echo $password2Err;?></span>	
						<input id="password2" class="" name="password2" type="password" placeholder ="Επανάληψη Κωδικού Πρόσβασης" onfocus="this.placeholder =''"onblur="this.placeholder ='Επανάληψη Κωδικού Πρόσβασης'">								
						
					</div>
				</form>
				<div class="row ">
					<div class="col-sm-4 col-sm-offset-4 col-xs-4 col-xs-offset-4">
						<button  name= "mpla" type="submit" form="form1" value="Submit" class="button-submit">Sign Up</button>
					</div>	
				</div>
				<div class="row ">
					<div class="success text-center lower">
						<?php echo $success?>
					</div>	
				</div>
				<div class="row ">
					<div class='lower'>
						<a href='login.php'>Έχετε ήδη λογαριασμό? Επιστροφή στη σελίδα σύνδεσης.</a>
					</div>	
				</div>
			</div>
		</div>
	</div>
	<footer>
		<script src="./js/DUjavascript.js"></script>
	</footer>
</body>
</html> 