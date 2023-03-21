<?php
session_start();
if (isset($_SESSION['Staff_ID']) && isset($_SESSION['Bkk_id']))  {
	//echo $_SESSION['Staff_ID'];
	//echo $_SESSION['Bkk_id'];
if(isset($_GET['identity'])){	
//echo $_GET['identity'];
}
else {
	unset($_SESSION["cart_item"]);
	//echo "all clear2";
}

require_once("dbcon2.php");
include("db_con.php");
$db_handle = new dbcon2();




if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":

	
	
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM item WHERE I_Code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["I_Code"]=>array('I_Name'=>$productByCode[0]["I_Name"], 'I_Code'=>$productByCode[0]["I_Code"], 'quantity'=>$_POST["quantity"], 'I_Price'=>$productByCode[0]["I_Price"], 'I_Image'=>$productByCode[0]["I_Image"]));
			 
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["I_Code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["I_Code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
			$bb_id=$_GET['identity'];
	$bb_id = str_pad($bb_id, 5, '0', STR_PAD_LEFT);
	$bb_code=$_GET['code'];
	
	$bb_qtty=$_POST['quantity'];
	$sql3 = "INSERT into booking_item (B_Id,I_Code,I_Qty) VALUES ('$bb_id','$bb_code','$bb_qtty')"; 
             if(mysqli_query($conn, $sql3)){
					
					echo '<script>alert("Item Added to Cart")</script>';
			} 
			else{
				echo "ERROR: Could not able to execute $sql3. " . mysqli_error($conn);
				}
			
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
			$bb_id=$_GET['identity'];
	$bb_id = str_pad($bb_id, 5, '0', STR_PAD_LEFT);
	$bb_code=$_GET['code'];
			
		$sql5="DELETE FROM booking_item WHERE B_Id='$bb_id' AND I_Code='$bb_code' ";
if(mysqli_query($conn, $sql5)){
					
					echo '<script>alert("Item Removed")</script>';
			} 
			else{
				echo "ERROR: Could not able to execute $sql5. " . mysqli_error($conn);
				}	
		}
	break;
	case "empty":{
		unset($_SESSION["cart_item"]);
		$bb_id=$_GET['identity'];
	$bb_id = str_pad($bb_id, 5, '0', STR_PAD_LEFT);	
		$sql6="DELETE FROM booking_item WHERE B_Id='$bb_id'";
if(mysqli_query($conn, $sql6)){
					
					echo '<script>alert("Cart Empty")</script>';

			} 
			else{
				echo "ERROR: Could not able to execute $sql5. " . mysqli_error($conn);
				}
	}
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>Add New Booking - Add Item</TITLE>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
<link href="style2.css" type="text/css" rel="stylesheet" />
<link href="cartcss.css" type="text/css" rel="stylesheet" />
<style>
 
</style>

</HEAD>
<BODY onload="zzz()">
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
<h2> Add New Booking - Add Item </h2>
</div>

<div class = "row">
<div class="section">
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="cart.php?action=empty&identity=<?php echo $_SESSION['Bkk_id']; ?>">Empty Cart</a>


<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>

<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["I_Price"];
		?>		
			
				<tr>
				<td><img src="data:image/jpeg;base64,<?php echo base64_encode( $item["I_Image"] );?>" width=50 height=50 /><?php echo $item["I_Name"]; ?></td>
				<td><?php echo $item["I_Code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "RM ".$item["I_Price"]; ?></td>
				<td  style="text-align:right;"><?php echo "RM ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["I_Code"]; ?>&identity=<?php echo $_SESSION['Bkk_id']; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["I_Price"]*$item["quantity"]);
		}
				
		?>
		<input type='hidden' name='total_price' value='<?php echo $total_price; ?>'>
		
<tr>
<td colspan="2" align="right">Total: </td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "RM ".number_format($total_price, 2); ?></strong></td>

</tr>
</tbody>

</table>	

<div class="row">
<form action ="addingextra.php" method ="post">
      <div class="col-25">
		<label for="Deposit" >Deposit </label>
      </div>
      <div class="col-75">
        <input type="number" onblur="calculate()" id="deposit" name="deposit" placeholder="RM00.00" style="width:100%; padding:12px; border:1px solid #ccc; border-radius:4px; resize:vertical;">
		<input type='hidden' name='ttl_price' id="ttl_price" value='<?php echo $total_price; ?>'>
      </div>

      <div class="col-25">
        <label for="Balance">Balance</label>
      </div>
      <div class="col-75">
        <input type="number" id="balance" name="balance" placeholder="RM00.00" value='' style="width:100%; padding:12px; border:1px solid #ccc; border-radius:4px; resize:vertical;">
      </div>
	  
	  <div class="col-25">
        <label for="Balance">Description </label>
      </div>
      <div class="col-75">
         <textarea id="desc" name="desc" placeholder="Addtional info provided by the customer." style="height:200px"></textarea>
      </div>
	  <input type='hidden' name='id_b' id="id_b" value='<?php echo $_GET['identity']; ?>'>
	  <input type='hidden' name='sff_b' id="sff_b" value='<?php echo  $_SESSION['Staff_ID']; ?>'>
	  <td><input type="submit" name="save" value="Save"></td>
    </div></form>	

<script>
calculate = function()
{
    var dep = document.getElementById('deposit').value;
    var ttl = document.getElementById('ttl_price').value; 
	var cal=ttl-dep;
    document.getElementById('balance').value = cal.toFixed(2);
     
   }
</script>
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM item ORDER BY I_Code ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["I_Code"]; ?>&identity=<?php echo $_SESSION['Bkk_id']; ?>">
			<div class="product-image"><img src="data:image/jpeg;base64,<?php echo base64_encode( $product_array[$key]['I_Image'] );?>" width=200 height=150 /></div> 
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["I_Name"]; ?></div>
			<div class="product-price"><?php echo "RM".$product_array[$key]["I_Price"]; ?></div>
			<div class="cart-action"><input type="number" class="product-quantity" name="quantity" value="1" size="2" /><br><br>
			<input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			
			<input type='hidden' name='i_code' value='<?php echo $product_array[$key]["I_Code"]; ?>'>
			
			</div>
			</form>
		</div>
		
		
	<?php
		}
	}
	?>
</div>
</div>
</div>
<div class="footer">
  <p>De More Order-In Booking System Prototype &copy; 2022.</p>
</div>
</BODY>
</HTML>

<?php


}

?>




