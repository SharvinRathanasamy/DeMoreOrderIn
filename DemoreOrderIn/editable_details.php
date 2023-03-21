<?php
session_start(); 
if(isset($_SESSION['Staff_ID']) && isset($_SESSION['Bkk_id'])){	
//echo $_SESSION['Staff_ID'];
	//echo $_SESSION['Bkk_id'];
$b_id=$_SESSION['Bkk_id'];

 ?>
<html>
<head>
<title>Booking Details - Edit</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <link href="details_css.css" type="text/css" rel="stylesheet" />  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

 
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
<div class = "row">
<h2> Booking Details- <?php echo $b_id; ?>  </h2>
</div>

<form action="openid.php" method="post">
			 <input type='hidden' name='id_b' id="id_b" value='<?php echo $_SESSION['Bkk_id']; ?>'>
				<input type='hidden' name='sff_b' id="sff_b" value='<?php echo  $_SESSION['Staff_ID']; ?>'>
			<td><input type="submit" name="back" value="Back"class="button1"></td>
			</form>
			
			
<div class="section">
		<div class="b_info">
<?php	
include "connection.php";
$b_method_opt  = array('Walk-in', 'Call', 'Whatsapp', 'Facebook', 'Others');
$b_sts_opt  = array('Complete', 'Incomplete', 'Cancelled');
$sql = "SELECT B_Id,C_Name,C_Phone,B_Date,B_PickupDate,B_PickupTime,B_OrderMethod,S_Name,S_Phone,staff.S_Id,B_Description,B_TotalPrice,B_Deposit,B_Balance,B_Status 
FROM booking JOIN staff
ON booking.S_Id=staff.S_Id GROUP BY B_Id HAVING B_Id='$b_id'
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
 $new_date = date('Y-m-d', strtotime($b_pickup_date));
?>

<h4><b>Issued date  <?php echo $b_date; ?> </b></h4>





<b>Booking Information</b>
<form name="Edit_form" action="#" method="post" enctype="multipart/form-data" >
<table>
			<tr>
				<td>Customer Name:</td>
				<td><input type="text" name='e_c_name' value='<?php echo $c_name; ?>'></td>
			</tr>
			
			<tr>	
				<td>Customer Phone:</td>
				<td><input type="text" name='e_c_contact' value='<?php echo $c_contact; ?>'></td>
			</tr>
			
			<tr>
				<td>Pick-up date:</th>
				<td> <input type="date" id="e_b_pickup_date" name='e_b_pickup_date' value='<?php echo $b_pickup_date ; ?>'></td>
			</tr>
			
			<tr>
				<td>Pick-up time:</th>
				<td><input type="time"  name='e_b_pickup_time' value='<?php echo $b_pickup_time; ?>'></td>
			</tr>
		
			<tr>
				<td>Order By:</th>
				<td> 
						<select name='e_b_method'>
							<?php 
			$selected1 = $b_method ;
foreach($b_method_opt as $b_method_opt){
        if($selected1 == $b_method_opt){
            echo "<option selected='selected1' value='$b_method_opt'>$b_method_opt</option>" ;
        }else{
            echo "<option value='$b_method_opt'>$b_method_opt</option>" ;
        }
    
}

			?>
			
						</select>	
				</td>
				
			</tr>

			<tr>
				<td>Booking Status:</th>
				<td> 
						<select name='e_b_status'>
							<?php 
			$selected2 = $b_sts ;
foreach($b_sts_opt as $b_sts_opt){
        if($selected2 == $b_sts_opt){
            echo "<option selected='selected2' value='$b_sts_opt'>$b_sts_opt</option>" ;
        }else{
            echo "<option value='$b_sts_opt'>$b_sts_opt</option>" ;
        }
    
}

			?>
			
						</select>	
				</td>
			</tr>

			<tr>
				<td>Staff:</td>
				<td><select name='e_b_staff'>
				
				<?php
$selected3 = $s_id ;

$sql2 = "SELECT * FROM staff";
			$result2 = $conn->query($sql2);
			 for($i=0; $row2 = $result2->fetch_assoc(); $i++){
				 
				 if($selected3 == $row2["S_Id"]){
            echo "<option selected='".$selected3."' value='".$row2["S_Id"]."'>".$row2["S_Id"]." - ".$row2["S_Name"]." -   ".$row2["S_Phone"]."</option>" ;
        }else{
            echo "<option value='".$row2["S_Id"]."'>".$row2["S_Id"]." - ".$row2["S_Name"]." -   ".$row2["S_Phone"]."</option>" ;
        }
				 
				 
				 
			 }
?>	
				
				
					</select>
			</td>
			</tr>

</table>
<input type="submit" name="edit_submit" value="Save">
</form>


		</div>
		
		
<div class="section">
		 <div id="live_data"></div>   

</div>	
		
		
	<div class="section">
		 <div id="desc">
		 <form name="Edit_form2" action="#" method="post" enctype="multipart/form-data" >
			 <table>
					 <tr>
					 
						 <td>
						 Description :&nbsp &nbsp
						 </td>
						
						 <td>
						 <textarea rows = "2" cols = "50" name = "e_bk_desc"><?php echo $b_desc?></textarea>
						 </td>
				 </tr>
			 </table>
			 <input type="submit" name="edit_submit2" value="Save">
		 </form>
		 
		 
		 
		 
		 
		 
		 </div>   

</div>		
		
		
		
		


</div>
		

<div class="footer">
  <p>De More Order-In Booking System Prototype &copy; 2022.</p>
</div>
<?php 



if(isset($_POST["edit_submit"]))
{



$date = $_POST["e_b_pickup_date"];
$e_bk_pd = date('Y-m-d', strtotime($date));

$e_bk_pt=$_POST["e_b_pickup_time"];
$e_ord_met=$_POST["e_b_method"];
$e_bk_sts=$_POST["e_b_status"];
$e_c_name=$_POST["e_c_name"];
$e_c_phn=$_POST["e_c_contact"]; 
$e_s_id=$_POST["e_b_staff"];

	
	
			
		$sql4 = "UPDATE booking 
		SET B_PickupDate='$e_bk_pd',B_PickupTime='$e_bk_pt', B_OrderMethod='$e_ord_met', B_Status='$e_bk_sts', C_Name='$e_c_name', C_Phone='$e_c_phn', S_Id='$e_s_id'
		WHERE B_Id = '$b_id' ;"; 
             if(mysqli_query($conn, $sql4)){
				 echo '<script>alert("Changes Saved")</script>';
				 
					echo "<meta http-equiv='refresh' content='0'>";
			}
			else{
				echo "ERROR: Could not able to execute $sql4. " . mysqli_error($conn);
				}

}

if(isset($_POST["edit_submit2"]))
{
$e_bk_descr=$_POST["e_bk_desc"];


	
	
			
		$sql5 = "UPDATE booking 
		SET B_Description='$e_bk_descr'
		WHERE B_Id = '$b_id' ;"; 
             if(mysqli_query($conn, $sql5)){
				 echo '<script>alert("Changes Saved")</script>';
				
					echo "<meta http-equiv='refresh' content='0'>";
			}
			else{
				echo "ERROR: Could not able to execute $sql5. " . mysqli_error($conn);
				}

}
?>
</body>

</html>
 <script>  
 $(document).ready(function(){
		var b_id = '<?php echo $b_id?>';
		
      function fetch_data()  
      {  
           $.ajax({  
                url:"b_details_select.php",  
                method:"POST", 
				data:{b_id:b_id}, 				
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      }  
      fetch_data();  
     $(document).on('click', '#btn_add', function(){  
         
        selectElement = document.querySelector('#selectitem');
        var item_code = selectElement.value;
		var item_qty = $('#add_qty').text();  
		
           if(item_code == "Choose an item")  
           {  
                alert("Select An Item");  
                return false;  
           }  
           if(item_qty == '' || isNaN(item_qty))  
           {  
                alert("Enter the quntity");  
                return false;  
           }  
           $.ajax({  
                url:"b_details_insert.php",  
                method:"POST",  
                data:{item_code:item_code, item_qty:item_qty, b_id:b_id},  
                dataType:"text",  
                success:function(data)  
                {  
                     alert(data);  
                     fetch_data();  
                }  
           })  
      });  
	  
	  
	  function edit_data(id, text, column_name)  
      {  
           $.ajax({  
                url:"edit.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                     alert(data); 
					fetch_data(); 					 
                }  
           });  
      }  
      $(document).on('blur', '.depo', function(){   	  
           var id = b_id;
           var first_name = $(this).text();  
           edit_data(id, first_name, "depo");  
      }); 
      
      $(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id3");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"b_details_delete.php",  
                     method:"POST",  
                     data:{id:id, b_id:b_id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });
 });  
 </script>

<?php } ?>						
						
						
	