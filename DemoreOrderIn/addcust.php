
<?php
session_start();
if (isset($_SESSION['Staff_ID']) ) {
	//echo $_SESSION['Staff_ID'];
include("db_con.php");
$m=date("Y-m-d");
//echo $m;
$sff_id = $_SESSION['Staff_ID'];;
$sql="SELECT S_Name,S_Phone from staff WHERE S_Id='$sff_id'";
	$result = $conn->query($sql);
			 for($i=0; $row = $result->fetch_assoc(); $i++){
			 $staff_name=$row['S_Name'];
			 $staff_phone=$row['S_Phone'];
			 
			 
			 }
	
?>


<head>
 <meta charset="utf-8" />
<title>Add New Booking - Customer Information </title> 
 <link rel="stylesheet" href="addcustcss.css">
 
</style>
</head>
<body>

<div class="header">
  <h1>DE MORE ORDER-IN BOOKING SYSTEM</h1> 
</div>

<div class="topnav">
 <a href="home.php">Home.Page</a>
  <a href="BookingHistory.php">History</a>
  <a href="item_index.php">Item Management</a>
  <a href="logout.php">LogOut</a>
</div>

<div class = "row">
<h2> Add New Booking - Customer Information </h2>
</div>

<div class="row">
  <div class="leftcolumn">
	 
    <div class="section">
<form  action="addingcust.php" method="post"> 	
      <h2>Customer's Information</h2>
		<div class="row">
      <div class="col-25">
		<label for="CName">Customer's Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="CName" name="C_Name" placeholder="Name" required>
      </div>
    </div>
	<div class="row">
      <div class="col-25">
        <label for="CPhonoNo">Customer's Contact No</label>
      </div>
      <div class="col-75">
        <input type="text" id="CPhonoNo" name="C_Phone" placeholder="  Contact Number eg:60123456789" style=" border:1px solid #ccc; width:590px; height:45px; border-radius:4px;" pattern="[6][0][1][0-9]{7-8}" required>
      </div>
    </div>
	<div class="row">
      <div class="col-25">
        <label for="PickDate">Pick-up Date</label>
      </div>
      <div class="col-75">
        <input type="date" id="PickDate" name="B_PickupDate" placeholder="Date" required>
      </div>
    </div>
	<div class="row">
      <div class="col-25">
        <label for="PickTime">Pick-up Time</label>
      </div>
      <div class="col-75">
        <input type="time" id="PickTime" name="B_PickupTime" placeholder="Pick-up time" required>
      </div>
    </div>
	<div class="row">
      <div class="col-25">
        <label for="Orderby">Order by</label>
      </div>
      <div class="col-75">
        <select id="Orderby" name="B_OrderMethod">
          <option value="Walk-in">Walk-in</option>
          <option value="Social Media">Social Media</option>
          <option value="Call">Call</option>
        </select>
      </div>
    </div>

   
	
    </div>
	
    
  </div>
  <div class="rightcolumn">
  <div class="section">
      <h2>Order Taken By</h2>
		<div class="row">
      <div class="col-25">
		<label for="SName">Staff Name:</label> <?php echo $staff_name; ?>
		<br>
		<br>
		<label for="SPhonoNo">Staff's Contact No:</label> <?php echo $staff_phone; ?>
      </div>
    </div>
    </div>
	
	<div class="section">
  
	<div class="row" >
	  <div class="align-right">
	<input type='hidden' name='staff_id' value="<?php echo $sff_id; ?>">
      <input type="submit" name="save" value="Save">
	 </div>
    </div>
  </div>
  </form>
  </div>
</div>

<div class="footer">
  <p>De More Order-In Booking System Prototype &copy; 2022.</p>
</div>

</body>

<?php


}
?>

