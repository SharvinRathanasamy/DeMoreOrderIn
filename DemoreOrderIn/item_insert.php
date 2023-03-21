<?php
include('connection.php');
include('item_function.php');
if(isset($_POST["operation"])){
	if($_POST["operation"] == "Add")
	{
		
		
	$file = addslashes(file_get_contents($_FILES["item_image"]["tmp_name"]));
	$a_item=$_POST["item_name"];
	$a_desc=$_POST["item_desc"];
	$a_price=$_POST["item_price"];
	$a_cat=$_POST["item_categ"];
	
	
	
	  $query = "INSERT INTO item (I_Name,I_Image,I_Description,	I_Price,I_Category) VALUES ('$a_item','$file','$a_desc','$a_price','$a_cat')";
	  if(mysqli_query($conn, $query))
	  {
				echo 'Data Inserted';
			}
		}
	
	
	
	
	
	if($_POST["operation"] == "Edit")
	{
		
		if($_FILES["item_image"]["name"] != '')
		{
			$e_file = addslashes(file_get_contents($_FILES["item_image"]["tmp_name"]));
			$e_item=$_POST["item_name"];
			$e_desc=$_POST["item_desc"];
			$e_price=$_POST["item_price"];
			$e_cat=$_POST["item_categ"];
			$e_id=$_POST["item_id"];
			
			
			$query2 = "UPDATE item 
					SET I_Name = '$e_item', I_Description ='$e_desc' , I_Price = '$e_price', I_Category = '$e_cat', I_Image ='$e_file' 
					WHERE I_Code = '$e_id'";
			  if(mysqli_query($conn, $query2))
			  {
						echo 'Data Updated';
					}
				else{
					echo 'Derror';
					
				}
		}
		else
		{
			$e_item=$_POST["item_name"];
			$e_desc=$_POST["item_desc"];
			$e_price=$_POST["item_price"];
			$e_cat=$_POST["item_categ"];
			$e_id=$_POST["item_id"];
			
			
			$query3 = "UPDATE item 
					SET I_Name = '$e_item', I_Description ='$e_desc' , I_Price = '$e_price', I_Category = '$e_cat' 
					WHERE I_Code = '$e_id'";
			  if(mysqli_query($conn, $query3))
			  {
						echo 'Data Updated';
					}
					else{
					echo 'Derror';
					
				}
		}
		
	
	
		}
	}


	





?>