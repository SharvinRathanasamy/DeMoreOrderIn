<?php
include('connection.php');
include('item_function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM item ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE I_Code LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR I_Name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR I_Category LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY I_Code ASC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	if($row["I_Image"] != '')
	{
		$image = '<img src="data:image/jpeg;base64,'.base64_encode( $row['I_Image'] ).'" width=220 height=205 />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $row["I_Code"];
	$sub_array[] = $row["I_Name"];
	$sub_array[] = $image;
	$sub_array[] = $row["I_Description"];
	$sub_array[] = $row["I_Price"];
	$sub_array[] = $row["I_Category"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["I_Code"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["I_Code"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>