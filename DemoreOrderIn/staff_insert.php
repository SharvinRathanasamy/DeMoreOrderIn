<?php
include('connection.php');
if(isset($_POST["operation"])){
	if($_POST["operation"] == "Add")
	{
		
		
	$st_name=$_POST["st_name"];
	$st_pass=$_POST["st_pass"];
	$st_phn=$_POST["st_phn"];
	$st_uname=$_POST["st_uname"];
	
	
	
	  $query = "INSERT INTO staff (S_Name,S_Password,S_Phone,S_Username) VALUES ('$st_name','$st_pass','$st_phn','$st_uname')";
	  if(mysqli_query($conn, $query))
	  {
				echo 'Data Inserted';
			}
		else{
					echo 'Derror';
					
				}	
		}
	
	
	
	
	
	if($_POST["operation"] == "Edit")
	{
		
			$st_name=$_POST["st_name"];
			$st_pass=$_POST["st_pass"];
			$st_phn=$_POST["st_phn"];
			$st_uname=$_POST["st_uname"];
			$e_id=$_POST["item_id"];
			
			
			$query2 = "UPDATE staff 
					SET S_Name = '$st_name', S_Password ='$st_pass' , S_Phone = '$st_phn', S_Username = '$st_uname'
					WHERE S_Id = '$e_id'";
			  if(mysqli_query($conn, $query2))
			  {
						echo 'Data Updated';
					}
				else{
					echo 'Derror';
					
				}
		}
		
		
	
	
		}
	
	
	

		/*$image = '';
		if($_FILES["item_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE item 
			SET I_Name = :item_name, I_Description = :item_desc, I_Price = :item_price, I_Category = :item_categ, I_Image = :item_image  
			WHERE I_Code = :id
			"
		);
		$result = $statement->execute(
			array(
				':item_name'	=>	$_POST["item_name"],
				':item_desc'	=>	$_POST["item_desc"],
				':item_price'	=>	$_POST["item_price"],
				':item_categ'	=>	$_POST["item_categ"],
				':item_image'	=>	$image,
				':id'			=>	$_POST["item_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}*/


	





?>