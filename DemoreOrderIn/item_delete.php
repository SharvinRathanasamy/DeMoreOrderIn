<?php

include('connection.php');
include("item_function.php");

if(isset($_POST["item_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM item WHERE I_Code = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["item_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}



?>