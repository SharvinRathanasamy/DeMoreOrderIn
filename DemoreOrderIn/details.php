<!DOCTYPE html>
<?php
session_start(); 
if(isset($_SESSION['Staff_ID']) && isset($_SESSION['Bkk_id'])){	
//echo $_SESSION['Staff_ID'];
	//echo $_SESSION['Bkk_id'];
$id=$_SESSION['Bkk_id'];

include "connection.php";
$b_method_opt  = array('Walk-in', 'Call', 'Whatsapp', 'Facebook', 'Others');
$b_sts_opt  = array('Complete', 'Incomplete', 'Cancelled');
$sql = "SELECT B_Id,C_Name,C_Phone,B_Date,B_PickupDate,B_PickupTime,B_OrderMethod,S_Name,S_Phone,staff.S_Id,B_Description,B_TotalPrice,B_Deposit,B_Balance,B_Status 
FROM booking JOIN staff
ON booking.S_Id=staff.S_Id GROUP BY B_Id HAVING B_Id='$id'
";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i=1){
$b_id=$row['B_Id'];	 
$c_name=$row['C_Name'];
$c_contact=$row['C_Phone'];
$b_date=$row['B_Date'];
$b_pickup_date=$row['B_PickupDate'];
$b_pickup_time=$row['B_PickupTime'];
$b_method=$row['B_OrderMethod'];
$s_name=$row['S_Name'];
$s_contact=$row['S_Phone'];
$s_id=$row['S_Id'];
$b_ttl=$row['B_TotalPrice'];
$b_depo=$row['B_Deposit'];
$b_bal=$row['B_Balance'];
$b_sts=$row['B_Status'];
$b_desc=$row['B_Description'];
 }
 $new_date = date('d-m-Y', strtotime($b_pickup_date));
?>
<html>
<head>
<title>Booking Details</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
<link href="details_css.css" type="text/css" rel="stylesheet" />
 
    
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
         


</head>
<body onload="zzz()">

<div class="header">
  <h1>DE MORE ORDER-IN BOOKING SYSTEM</h1> 
</div>

<div class="topnav">
<a href="home.php">Home</a>
  <a href="BookingHistory.php">History</a>
  <a href="item_index.php">Item Management</a>
  <a href="logout.php">LogOut</a>
</div>

		




<div class = "row">
<h2> Booking Details- <?php echo $b_id; ?>  </h2>
</div>

<b>Issued date  <?php echo $b_date; ?> </b>


<div>
<form action="openid.php" method="post">
			 <input type='hidden' name='id_b' id="id_b" value='<?php echo $_SESSION['Bkk_id']; ?>'>
				<input type='hidden' name='sff_b' id="sff_b" value='<?php echo  $_SESSION['Staff_ID']; ?>'>
			<td><input type="submit" name="edit" value="Edit" class="button1"></td>
			</form>
</div>

<div class= "details" id="details">
<div class="section">
<h2>Customer Information</h2>
<table>
			<tr>
				<td>Customer Name:</td>
				<td><?php echo $c_name; ?></td>
			</tr>
			
			<tr>	
				<td>Customer Phone:</td>
				<td><?php echo$c_contact; ?></td>
			</tr>
			
			<tr>
				<td>Pick-up date:</th>
				<td><?php echo $new_date; ?></td>
			</tr>
			
			<tr>
				<td>Pick-up time:</th>
				<td><?php echo $b_pickup_time ; ?></td>
			</tr>
			
			<tr>
				<td>Order By:</th>
				<td><?php echo $b_method ; ?></td>
			</tr>
			
			<tr>
				<td>Booking Status:</th>
				<td><?php echo $b_sts  ;?></td>
			</tr>
</table>

</div>
<div class="section">
<h2>Staff Information</h2>
<table>
			<tr>
				<td>Staff Name:</td>
				<td><?php echo $s_id; ?>- <?php echo $s_name; ?></td>
			</tr>
			
			<tr>	
				<td>Staff Contact Number:</th>
				<td><?php echo $s_contact; ?></td>
			</tr>
</table>
		
						
	</div>
<div class="section">	
						
						
						
						
<table>
		<thead>
			<tr>
				
				<th>N.o</th>
				<th>&nbsp &nbsp &nbsp &nbspItem Code</th>
				<th>&nbsp &nbsp &nbsp &nbspItem Name</th>
				<th>&nbsp &nbsp &nbsp &nbspItem Quantity</th>
				<th>&nbsp &nbsp &nbsp &nbsp Amount (RM)</th>
			</tr>
		</thead>
<?php	

$sql2 = "SELECT item.I_Code,item.I_Name, item.I_Price, booking_item.I_Qty 
FROM booking_item 
JOIN booking ON booking_item.B_Id=booking.B_Id
JOIN item ON booking_item.I_Code=item.I_Code
WHERE booking.B_Id='$id'";
$result2 = $conn->query($sql2);
$j=0;
 for($i=0; $row2 = $result2->fetch_assoc(); $i++){

?>					


			<tr>
			<td><?php $j=$i+1;
			echo $j; ?></td>
				<td><label>&nbsp &nbsp &nbsp &nbsp <?php echo $row2['I_Code']; ?></label></td>
				<td><label>&nbsp &nbsp &nbsp &nbsp <?php echo $row2['I_Name']; ?></label></td>
				<td><label>&nbsp &nbsp &nbsp &nbsp <?php echo $row2['I_Qty']; ?></label></td>
				<td><label>&nbsp &nbsp &nbsp &nbsp <?php echo $row2['I_Price']; ?></label></td>
				
			</tr>

					<?php
}
						?>
						
			<tr class="1"><td colspan="4">Total Price</td>
					<td>&nbsp &nbsp &nbsp &nbsp <?php echo $b_ttl; ?></td>
			</tr>
			<tr class="2"><td colspan="4">Deposit</td>
					<td>&nbsp &nbsp &nbsp &nbsp <?php echo $b_depo; ?></td>
			</tr>
			<tr class="3"><td colspan="4">Balance</td>
					<td>&nbsp &nbsp &nbsp &nbsp <?php echo $b_bal; ?></td>
			</tr>
			
			</tr>
			<tr class="4"><td>Description</td>
					<td colspan="4">
					&nbsp &nbsp &nbsp &nbsp 
					<textarea id="w3review" name="w3review" rows="4" cols="50"><?php echo $b_desc; ?>
					</textarea>
					</td>
			</tr>

	</table>
	
	
	<br>
	<br>
	
</div>	
</div>

<form method="post">
						<input type='hidden' name='edit_d_b_id' value='<?php echo $b_id; ?>'>
						<input type="submit" name="cancel" id="cancel" class="button2" value="CANCEL" />
</form>


<form method="post">
						<input type='hidden' name='edit_c_b_id' value='<?php echo $b_id; ?>'>
						
					<input type="submit" name="complete" id="complete" class="button3" value="COMPLETE" />
</form>


<div class="footer">
  <p>De More Order-In Booking System Prototype &copy; 2022.</p>
</div>

</body>
<script>
zzz = function() { 
    var bk_status = '<?php echo $b_sts?>';
    if (bk_status == "Cancelled")
	{
        document.getElementById("cancel").disabled = true; 
	document.getElementById("complete").disabled = true; 
	document.getElementById("edit_b").disabled = true; 
	}
	else if(bk_status == "Complete")
	{	document.getElementById("cancel").disabled = true; 
		document.getElementById("complete").disabled = true; 
	}
	
		
   
}


</script>


<?php
if(isset($_POST["cancel"])){
$did=$_POST["edit_d_b_id"];
echo $did;
$sql6="UPDATE booking 
		SET B_Status='Cancelled'
		WHERE B_Id=$did";
if(mysqli_query($conn, $sql6)){
					echo '<script>alert("This Booking Cancelled")</script>';
					echo "<meta http-equiv='refresh' content='0'>";
			} 
			else{
				echo "ERROR: Could not able to execute $sql5. " . mysqli_error($conn);
				}
}


if(isset($_POST["complete"])){
$did=$_POST["edit_c_b_id"];
echo $did;
$sql7="UPDATE booking 
		SET B_Status='Complete'
		WHERE B_Id=$did";
if(mysqli_query($conn, $sql7)){
					echo '<script>alert("This Booking Complete")</script>';
					echo "<meta http-equiv='refresh' content='0'>";
			} 
			else{
				echo "ERROR: Could not able to execute $sql5. " . mysqli_error($conn);
				}
}
}

?>
</html>


						
						
						
	