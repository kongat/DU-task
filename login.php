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
	session_start();
	$userEmailErr = $passwordErr = $hashed_password = $loginErr="";
	$userEmail = $password1 = "";
    $errors = 0;
	
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
	  
		if (empty($_POST["userEmail1"])) {
			$userEmailErr = "Δεν έχετε συμπληρώσει το Email σας!";
			$errors++;
		} else {
			$userEmail = test_input($_POST["userEmail1"]);
			
			if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
				$userEmailErr = "Δεν έχετε εισάγει έγκυρο email!";
				$errors++;
			}
		}
		  
		if (empty($_POST["password"])) {
			$passwordErr = "Δεν έχετε συμπληρώσει κωδικό πρόσβασης!";
			$errors++;
		} else {
			$password1 = test_input($_POST["password"]);
		}
      
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
			
			if (mysqli_num_rows($result) == 1 ) {
				$row = $result->fetch_assoc();
			    $hashed_db_password =$row["hashed_password"];
		
				if (password_verify($password1,$hashed_db_password)){
					
					$_SESSION['user_email'] = $row["email"];
					mysqli_close($conn);
					header("location: welcome.php");
					
				}else{
					$loginErr="Λάθος κωδικός,ξαναπροσπαθήστε";
				}
				
			}else{
				$loginErr="Ο συγκεκριμένος λογαρισμός δεν υπάρχει";
			}
			mysqli_close($conn);
		   
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
			<div class="col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2">
				<p class="lower">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean commodo neque sit amet consectetur rutrum.
					Etiam eros augue, tincidunt eget ex a, faucibus hendrerit dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
					Pellentesque consectetur lacinia ex ac finibus. 
				</p>
				<h4 class="text-center lower">Log In</h4>
				
				<form id="form2" name="myForm2" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
					    <span class="error" id="email-error"> <?php echo $userEmailErr;?></span>							
						<input id="userEmail1" class="" name="userEmail1" type="email" placeholder ="Email" onfocus="this.placeholder =''"onblur="this.placeholder ='Email'">
						
						<span class="error" id="password-error"> <?phpecho $passwordErr;?></span>							
						<input id="password" class="" name="password" type="password" placeholder ="Κωδικός Πρόσβασης" onfocus="this.placeholder =''"onblur="this.placeholder ='Κωδικός Πρόσβασης'">	
					</div>
				</form>
				<div class="row ">
					<div class="col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2">
						<button  name= "mpla" type="submit" form="form2" value="Submit" class="button-submit ">Login</button>
					</div>	
				</div>
				<div class="row ">
					<div class="error text-center lower">
						<?php echo $loginErr?>
					</div>	
				</div>
				<div class="row ">
					<div class='lower'>
						<a href='create-account.php'>Νέος λογαριασμός.</a>
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