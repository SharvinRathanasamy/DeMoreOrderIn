<?php

include('connection.php');

if(isset($_POST["item_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM staff WHERE S_Id = :id"
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