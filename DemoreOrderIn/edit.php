<?php  
include "connection.php";
 $id = $_POST["id"];  
 $depo = $_POST["text"];  
 $column_name = $_POST["column_name"];  
 
 $sql2 = "SELECT B_TotalPrice FROM booking WHERE B_Id='$id'";
$result2 = $conn->query($sql2);
 for($i=0; $row2 = $result2->fetch_assoc(); $i++){
	 $ttp= $row2['B_TotalPrice'];
 }
  $nbal=$ttp-$depo;
  
 
 $sql = "UPDATE booking SET B_Deposit='$depo', B_Balance='$nbal' WHERE B_Id='$id'";  
 if(mysqli_query($conn, $sql))  
 {  
      echo 'Data Updated';  
 }  
 ?>