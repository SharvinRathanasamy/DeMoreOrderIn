<?php
session_start();
if (isset($_SESSION['Staff_ID']) ) {
	//echo $_SESSION['Staff_ID'];
include "connection.php";
$id= $_SESSION['Staff_ID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UserProfile</title>
  <script src="myjavascript.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>
  <link rel="stylesheet" href="style3.css">
</head>

<body>
	<header>
		<h1>DE MORE ORDER-IN BOOKING SYSTEM</h1>
	</header>

 <div class="profile-card" style="margin: auto; margin-top: 100px;">
    <div class="card-header">
      <div class="pic">
        <form action="" method="post" enctype="multiport/form-data">
        <img src="images/icon.jfif" id="photo" >
	</form>
      </div>
	
     <div class="name">Staff</div>
     </div>
    <div class="card-footer">

	<?php
	$sql = "SELECT * from staff where S_Id='$id' 
";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i=1){
	?>

	<form action="" method="post" >
	<label for="s_id">Staff-Id : </label>
	<input readonly type="text" name="s_id" value="<?php echo $row['S_Id']; ?>"  style="height: 30px; padding: 12px 50px; border: 2px solid #302920; border-radius: 6px; margin-top: 16px;" ><br>
	<label for="sname">Name : </label>
	<input type="text" name="sname"  value="<?php echo $row['S_Name']; ?>" style="height: 30px; padding: 12px 50px; border: 2px solid #302920; border-radius: 6px; margin-top: 16px;" required><br>
	<label for="p_number">Phone-No : </label>
	<input type="tel" name="p_number" value="<?php echo $row['S_Phone']; ?>" style="height: 30px; padding: 12px 50px; border: 2px solid #302920; border-radius: 6px; margin-top: 16px;" pattern="[6][0][1][0-9]{7-8}" required > <br>
	<label for="u_name">Username : </label>
	<input type="text" name="u_name" value="<?php echo $row['S_Username']; ?>" style="height: 30px; padding: 12px 50px; border: 2px solid #302920; border-radius: 6px; margin-top: 16px;"  minlength="5" maxlength="12" required> <br>
	<label for="password">Password : </label>
	<input type="password" name="password" id="myInput" value="<?php echo $row['S_Password']; ?>" style="height: 30px; padding: 12px 50px; border: 2px solid #302920; border-radius: 6px; margin-top: 16px;" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$&+,:;=?@#|'<>.^*()%!-]).{8,12}" minlength="8" maxlength="12" required><br>
	
	<input type="checkbox" onclick="myFunction1()" style="margin: 10px  0 0 18.2%; float: left;" ><p style=" font-size: 15px; float: left; margin:7px 0 0 1.2%;">Show Password</p>
	<button name="close" class="cancel"style="float: left; margin:10px 0 0 18.2%;">Back</button>
	<a href="home.php"><button class="done" type="submit" name="update" style="float: right; margin:10px 18.2% 0 0;">Done</button></a>
	
	<?php
 }
	if(isset($_POST['update']))
	{
	
	$sql5 = "UPDATE staff SET S_Name='$_POST[sname]',S_Password='$_POST[password]', S_Phone='$_POST[p_number]',S_Username='$_POST[u_name]' 
	     WHERE s_id='$id' "; //"; 
	
	 if(mysqli_query($conn, $sql5))
	{
	echo '<script type="text/javascript"> alert("Your Data succesfully updated") </script>';
	echo "<meta http-equiv='refresh' content='0'>";
	
	}
	else
	{
	echo '<script type="text/javascript"> alert("Your Data not updated") </script>';	
	}
	}
if(isset($_POST['close'])){
	$_SESSION['Staff_ID'];
	header('location: home.php');
	
	
}

	?>
	</form>

        <div class="border"></div>
        
        </div>
      </div>
    </div>
  </div>

<script> 
function myFunction1() {
	var x =
document.getElementById("myInput");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}
</script>


</body>
</html>
<?php }?>