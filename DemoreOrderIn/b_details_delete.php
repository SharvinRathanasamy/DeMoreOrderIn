<?php  
include "connection.php";
 $sql = "DELETE FROM booking_item WHERE B_Id = '".$_POST["b_id"]."' AND I_Code='".$_POST["id"]."'";  
 if(mysqli_query($conn, $sql))  
 {  
     
	  
		$ttl_price=0;
		$new_bal=0;
		$query = "SELECT * FROM booking_item WHERE B_Id = '".$_POST["b_id"]."'";
		$results = mysqli_query($conn, $query);
		$rows = mysqli_num_rows($results);
		
		
	  if ($rows === 0){
					$new_bal=number_format((float)$new_bal, 2, '.', '');
					$ttl_price=number_format((float)$ttl_price, 2, '.', '');
					 $sql4 = "UPDATE booking SET B_TotalPrice = '".$ttl_price."', B_Balance = '".$new_bal."'
							  WHERE B_Id='".$_POST["b_id"]."'";
					 if(mysqli_query($conn, $sql4))  
					 {  
						   echo 'All the Data Deleted';  
					 }
					 else{
						 echo 'Something went Wrong'; 
					 }
		  
	  }
	  else if ($rows !== 0)
	  {
		  
			   $sql3 = "SELECT item.I_Name,item.I_Price, booking_item.I_Qty,booking.B_Deposit
					FROM booking_item
					JOIN item ON booking_item.I_Code=item.I_Code
					JOIN booking ON booking_item.B_Id=booking.B_Id
					WHERE booking.B_Id='".$_POST["b_id"]."'
				";  
			 $result3 = mysqli_query($conn, $sql3); 
			 while($row3 = mysqli_fetch_array($result3))  
				  {
					  $ttl_price= $ttl_price +($row3["I_Qty"]*$row3["I_Price"]);
					  $ttl_price=number_format((float)$ttl_price, 2, '.', '');
					  $depo=$row3["B_Deposit"];
				  }
		  
					 $new_bal= $ttl_price - $depo;
					 $new_bal=number_format((float)$new_bal, 2, '.', '');
					  
					 $sql2 = "UPDATE booking SET B_TotalPrice = '".$ttl_price."', B_Balance = '".$new_bal."'
							  WHERE B_Id='".$_POST["b_id"]."'";
					 if(mysqli_query($conn, $sql2))  
					 {  
						  echo 'Data Deleted';   
					 }
					 else{
						 echo 'Something went Wrong'; 
					 }
	  }
	  else{
		  echo'something went wrong';
	  }
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
 }  
 else
 {
	 echo'something went wrong';
 }
 ?>