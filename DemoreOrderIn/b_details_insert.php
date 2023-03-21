<?php  
include "connection.php";
 
	$ttl_price=0;
	$query = "SELECT * FROM booking_item WHERE B_Id = '".$_POST["b_id"]."' and  I_Code='".$_POST["item_code"]."'";
	$results = mysqli_query($conn, $query);
	$rows = mysqli_num_rows($results);
	
 if ($rows === 0) { 
	 $sql = "INSERT INTO booking_item(B_Id, I_Code,	I_Qty) VALUES('".$_POST["b_id"]."', '".$_POST["item_code"]."', '".$_POST["item_qty"]."')";  
	 if(mysqli_query($conn, $sql))  
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
						  echo 'Data Inserted'; 
					 }
					 else{
						 echo 'Something went Wrong'; 
					 }
	 }
	 else{
		 echo 'Something went Wrong'; 
	 }
	  
}
else{
	 echo 'This Item already added';  
}





  
 ?> 