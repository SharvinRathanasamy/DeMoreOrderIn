<?php
include('connection.php');
include('item_function.php');
if(isset($_POST["item_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM item 
		WHERE I_Code = '".$_POST["item_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["item_name"] = $row["I_Name"];
		$output["item_desc"] = $row["I_Description"];
		$output["item_price"] = $row["I_Price"];
		$output["item_categ"] = $row["I_Category"];
		if($row["I_Image"] != '')
		{
			$output['I_Image'] = '<img src="data:image/jpeg;base64,'.base64_encode( $row['I_Image'] ).'" class="img-thumbnail" width="250" height="235" /><input type="hidden" name="hidden_user_image" value="'.base64_encode( $row['I_Image'] ).'" />';
		}
		else
		{
			$output['I_Image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>