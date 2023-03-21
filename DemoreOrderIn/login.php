<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="login_stylesheet.css">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
</head>

<body>
<header></header>
<div class="main">
	<p class="login" align="center">Login</p>
	<form class="form1" method="post">
	<input class="un" type="text" align="center" placeholder="Username" name="Username" id="Username"required>
	<input class="pwd" type="password" align="center" placeholder="Password" id="myInput" name="myInput" required>
	<input type="checkbox" onclick="myFunction()">
	<input type="submit" class="submit" align="center" id="submit" name="submit">
	</form> 

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>	
                
</div>
     
</body>
<footer></footer>

</html>

<?php
session_start(); 
include_once('config.php');
$errors = array();

// connect to the database



// LOGIN USER
if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['Username']);
  $password = mysqli_real_escape_string($conn, $_POST['myInput']);

  if (empty($username)) {
  	echo "Username is required";
  }
  if (empty($password)) {
  	echo "Password is required";
  }

  if (count($errors) == 0) {
  	$password = $password;
  	$query = "SELECT * FROM staff WHERE S_Username='$username' AND S_Password='$password'";
  	$results = mysqli_query($conn, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $row = $results->fetch_assoc();
  	  $_SESSION['success'] = "You are now logged in";
	  $_SESSION['S_Id'] = $row['S_Id'];
  	 echo "<script language='javascript'>";
			echo "alert('Successfully Login in')";
			echo "</script>";
			$_SESSION['Staff_ID'] = $row['S_Id'];
			 header('location: home.php');
  	}
	
	else {
		 echo "<script language='javascript'>";
			echo "alert('Wrong username/password combination')";
			echo "</script>";
  		
  	}
  }
}



?>

