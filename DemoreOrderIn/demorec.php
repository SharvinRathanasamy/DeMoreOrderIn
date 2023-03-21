<?php 
include "connection.php";
session_start();

if (isset($_SESSION['Staff_ID']) && isset($_SESSION['Bkk_id']))  {
	//echo $_SESSION['Staff_ID'];
	//echo $_SESSION['Bkk_id'];
$r_id=$_SESSION['Bkk_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="receiptr.css">
    <title>Add New Booking - Receipt</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script type="text/javascript">

    window.onload = function () {
    document.getElementById("download")
       .addEventListener("click", () => {
           const pageCenter = this.document.getElementById("pageCenter");
           console.log(pageCenter);
           console.log(window);
           var opt = {

               rMargin: -1,
               bMargin: -1,
               filename: 'myfile.pdf',
               html2canvas: { scale: 2 },
               jsPDF: { unit: 'in', format: 'a2', orientation: 'portrait', floatPrecision: 16 }
           };
           html2pdf().from(pageCenter).set(opt).save();
       })
}

</script>
</head>
<body>
<div class="header">
  <h1>DE MORE ORDER-IN BOOKING SYSTEM</h1> 
</div>

<div class="topnav">
  <a href="home.php">Home</a>
  <a href="BookingHistory.php">History</a>
  <a href="item_index.php">Item Management</a>
  <a href="logout.php">LogOut</a>
</div>

<div class="pageCenter" id="pageCenter">
                <h2>DE MORE BAKERY</h2>
            
                <div class="top-left">
                    <p>No.7,Jalan PNBB 2,Bukit </p>
                    <p>Baru Seksyen IV, 75150</p>
                    <p>Malacca City,Malacca,</p>
                    <p>Malaysia.</p>
                </div>
                <div class="top-right">
                    <p>Tel:016-7971009</p>
                    <p>Email:sweepingkee@hotmail.com</p>
                    <p>Facebook:De More Bakery</p>
                </div>

<br><br><br><br><br><br><br><br><br>
<hr color = "black">
<div class = "row">
 <?php
     $connection = mysqli_connect("localhost","root","","test");
     $query = "SELECT * FROM booking WHERE B_Id = '$r_id';";
     $result = mysqli_query($conn, $query);

     $row = mysqli_fetch_array($result);
     $B_Id = $row[0];
     $B_Date = $row[1];
       
 echo "Booking ID: $B_Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Issued Date: $B_Date";
 ?>
</div>
<h3>Customer's Information</h3>
<div class = "custinfo">
<?php
    $connection = mysqli_connect("localhost","root","","test");
    $query = "SELECT * FROM booking WHERE B_Id = '$r_id';";
    $result = mysqli_query($conn, $query);
    
    $row = mysqli_fetch_array($result);
    //print_r($row);
    $C_Name = $row[10];
    $C_Phone = $row[11];
    $B_PickupDate = $row[2];
    $B_PickupTime = $row[3];

    echo "Customer's Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$C_Name";
    echo"<br>";
    echo"<br>";
    echo "Customer's Contact No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$C_Phone";
    echo"<br>";
    echo"<br>";
    echo "Pick Up Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $B_PickupDate";
    echo"<br>";
    echo"<br>";
    echo "Pick Up Time: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $B_PickupTime";

?>
</div>

<hr color = "black">
<div class="section">	
						
						
						
<h3>Booked Item</h3>						
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

$connection = mysqli_connect("localhost","root","","test");
$query = "SELECT booking.B_TotalPrice,booking.B_Deposit,booking.B_Balance,booking.B_Description,item.I_Code,item.I_Name, item.I_Price, booking_item.I_Qty 
FROM booking_item 
JOIN booking ON booking_item.B_Id=booking.B_Id
JOIN item ON booking_item.I_Code=item.I_Code
WHERE booking.B_Id=$r_id;";
$result = mysqli_query($conn, $query);
$j=0;
 for($i=0; $row2 = $result->fetch_assoc(); $i++){

?>					


			<tr>
			<td><?php $j=$i+1;
			echo $j; ?></td>
				<td><label>&nbsp &nbsp &nbsp &nbsp <?php echo $row2['I_Code']; ?></label></td>
				<td><label>&nbsp &nbsp &nbsp &nbsp <?php echo $row2['I_Name']; ?></label></td>
				<td><label>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $row2['I_Qty']; ?></label></td>
				<td><label>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $row2['I_Price']; ?></label></td>
				
			</tr>

					
            <?php
}
						?>

	</table>
    <br>
    <div class = "itemlist">
	<?php
    $connection = mysqli_connect("localhost","root","","test");
    $query = "SELECT * FROM booking WHERE B_Id = '$r_id';";
    $result = mysqli_query($conn, $query);
    
    $row = mysqli_fetch_array($result);
    //print_r($row);
    $B_TotalPrice = $row[6];
    $B_Deposit = $row[7];
    $B_Balance = $row[8];
    $B_Description = $row[5];

    echo "TOTAL: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$B_TotalPrice";
    echo"<br>";
    echo"<br>";
    echo "DEPOSIT: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$B_Deposit";
    echo"<br>";
    echo"<br>";
    echo "BALANCE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$B_Balance";
    echo"<br>";
    echo"<br>";
    echo"Description: &nbsp;&nbsp;&nbsp;&nbsp;$B_Description";

?>
</div>
	
</div>	
</div>
<br>


 <a href="home.php">
     <button class="clbt">Back</button>
    </a>


<a href="#">
    <button class="prt" id="download">Print</button>
</a>



<div class="footer">
  <p>De More Order-In Booking System Prototype &copy; 2022.</p>
</div>

  </body>
</html>
<?php }?>