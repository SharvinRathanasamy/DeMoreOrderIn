<?php

function upload_image()
{
	if(isset($_FILES["item_image"]))
	{
		$extension = explode('.', $_FILES['item_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		move_uploaded_file($_FILES['item_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($item_id)
{
	include('connection.php');
	$statement = $connection->prepare("SELECT I_Image FROM item WHERE I_Code = '$item_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["I_Image"];
	}
}

function get_total_all_records()
{
	include('connection.php');
	$statement = $connection->prepare("SELECT * FROM item");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>