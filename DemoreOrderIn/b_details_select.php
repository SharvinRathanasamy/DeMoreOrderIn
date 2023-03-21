<?php  
if (isset($_SESSION['Staff_ID']) ) {
	echo $_SESSION['Staff_ID'];
}
include "connection.php";
 $output = '';  
 $sql = "SELECT item.I_Code,item.I_Name, item.I_Price, booking_item.I_Qty 
FROM booking_item 
JOIN booking ON booking_item.B_Id=booking.B_Id
JOIN item ON booking_item.I_Code=item.I_Code
WHERE booking.B_Id='".$_POST["b_id"]."';";  
 $result = mysqli_query($conn, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr> 
                     <th width="10%">Item Code</th>  
                     <th width="25%">Item Name</th> 
					 <th width="40%">Price per unit (RM)</th>  
                     <th width="10%">Quantity</th>  
					 <th width="40%">Price (RM)</th>  
                     <th width="10%">Delete</th>  
                </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
  
  
			$price2= $row["I_Qty"]*$row["I_Price"];
			$price2=number_format((float)$price2, 2, '.', '');
           $output .= '  
                <tr>  
					 <td>'.$row["I_Code"].'</td> 
                     <td>'.$row["I_Name"].'</td> 
					 <td>'.$row["I_Price"].'</td> 					 
                     <td class="quantity" data-id1="'.$row["I_Code"].'" >'.$row["I_Qty"].'</td>  
                      
					 <td>'.$price2.'</td>
                     <td><button type="button" name="delete_btn" data-id3="'.$row["I_Code"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>  
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td id="add_item" colspan="3">
						<select id="selectitem">
							<option>Choose an item</option>
						</select>
				</td> 
				<td id="add_qty" contenteditable ></td>				
                <td colspan="3"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '  
           <tr>  
                <td id="add_item" colspan="3">
						<select id="selectitem">
							<option>Choose an item</option>
						</select>
				</td> 
				<td id="add_qty" contenteditable ></td>				
                <td colspan="3"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
           </tr>  
      ';    
 }  
 
 
 
 
 
 $sql3 = "SELECT B_TotalPrice,B_Deposit,B_Balance FROM booking WHERE B_Id='".$_POST["b_id"]."'";  
 $result3 = mysqli_query($conn, $sql3); 
 while($row3 = mysqli_fetch_array($result3))  
      {
		  $b_ttl=$row3["B_TotalPrice"];
		  $b_depo=$row3["B_Deposit"];
		  $b_bal=$row3["B_Balance"];
	  }
	  
	  
 $output .= '
 
			<tr>
				<td colspan="4">Total Price</td>
				<td colspan="2" id="ttl" contenteditable>'.$b_ttl.'</td>
			</tr>
			
			<tr>
				<td colspan="4">Deposit</td>
				<td colspan="2" class="depo" data-id1="'.$_POST["b_id"].'" contenteditable>'.$b_depo.'</td> 
			</tr>
			
			<tr>
				<td colspan="4">Balance</td>
				<td colspan="2" id="bal" contenteditable>'.$b_bal.'</td>
			</tr>
 
 
 
		</table>  
      </div>';  
 echo $output;  
 ?>
 <script>
 var select = document.getElementById("selectitem");
 <?php
  $sql2 = "SELECT * FROM item";  
 $result2 = mysqli_query($conn, $sql2); 
 while($row2 = mysqli_fetch_array($result2))  
      {  
  
  $option="";
  
  ?>
  
  var opt = '<?php echo $row2["I_Code"]?>';
	 var opt2 = '<?php echo $row2["I_Name"]."    - RM ".$row2["I_Price"] ?>';
    var el = document.createElement("option");
    el.textContent = opt2;
    el.value = opt;
    select.appendChild(el);
  
  
  
  
  
  
  
  
  <?php
	  }
 
 
 ?>
 
/*var options2 = ["0", "2", "3", "4", "5"];
var options = ["ppp", "qqq", "rrr", "vvv", "ttt"];

for(var i = 0; i < options.length; i++) {
    var opt = options[i];
	 var opt2 = options2[i];
    var el = document.createElement("option");
    el.textContent = opt;
    el.value = opt2;
    select.appendChild(el);
}*/
 </script>