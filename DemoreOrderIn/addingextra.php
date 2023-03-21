<?php 
session_start(); 
include "connection.php";

if(isset($_POST["save"])){
include("db_con.php");
$ttl_p =$_POST['ttl_price'];
$dep_p =$_POST['deposit'];
$bal_p =$_POST['balance'];
$dec =$_POST['desc'];
$bbb_id=$_POST['id_b'];
$s_id=$_POST['sff_b'];

$sql9 = "UPDATE booking SET B_TotalPrice='$ttl_p',B_Deposit= '$dep_p' ,B_Balance= '$bal_p' ,B_Description='$dec' 
			WHERE B_Id = '$bbb_id';"; 
             if(mysqli_query($conn, $sql9)){
					echo "Records added successfullyB.";
					echo $s_id;
					echo $bbb_id;
					$_SESSION['Bkk_id'] = $bbb_id;
									 $_SESSION['Staff_ID'];
									 header('location: demorec.php');
					
			} 
			else{
				echo "ERROR: Could not able to execute $sql9. " . mysqli_error($conn);
				}

}




?>