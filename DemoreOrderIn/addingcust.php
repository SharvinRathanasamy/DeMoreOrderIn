<?php 
session_start(); 
include "connection.php";


if(isset($_POST["save"])){

$b_date =date("Y-m-d");
$b_pickupdate =$_POST['B_PickupDate'];
$b_pickuptime =$_POST['B_PickupTime'];
$b_ordermethod =$_POST['B_OrderMethod'];

$b_status ="Incomplete";
$c_name =$_POST['C_Name'];
$c_phone =$_POST['C_Phone'];
$s2_id =$_POST['staff_id'];







 $sql2 = "INSERT into booking (B_Id,B_Date, B_PickupDate, B_PickupTime,B_OrderMethod,B_Status,C_Name,C_Phone,S_Id) 
			VALUES ('','$b_date','$b_pickupdate','$b_pickuptime','$b_ordermethod','$b_status','$c_name','$c_phone','$s2_id')"; 
             if(mysqli_query($conn, $sql2)){
					echo "Records added successfully.";
					
					
					$sql3 = "SELECT B_Id FROM booking WHERE B_Id = (SELECT MAX(B_Id) FROM booking) AND C_Phone='$c_phone';";
								$result3 = $conn->query($sql3);
								 for($i=0; $row8 = $result3->fetch_assoc(); $i++){
									 echo "hell yeag";
									 $bked_id=$row8['B_Id'];
									 }
									
									 echo $bked_id;
									 $_SESSION['Bkk_id'] = $bked_id;
									 $_SESSION['Staff_ID'];
									 header('location: cart.php');
									 /*?>
									
									 <script type="text/javascript">
									  var link= "cart.php? identity=";
									 location.replace(link);</script>
									 
									 <?php */
		
			} 
			else{
				echo "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
				}
				


}

?>