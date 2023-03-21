<?php
include('connection.php');
if(isset($_POST["item_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM staff 
		WHERE S_Id = '".$_POST["item_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["st_name"] = $row["S_Name"];
		$output["st_pass"] = $row["S_Password"];
		$output["st_phn"] = $row["S_Phone"];
		$output["st_uname"] = $row["S_Username"];
	}
	echo json_encode($output);
}
?>