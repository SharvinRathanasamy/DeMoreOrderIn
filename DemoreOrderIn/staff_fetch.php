<?php
include('connection.php');
include('staff_function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM staff ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE S_Id LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR S_Name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR S_Phone LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY S_Id ASC ';
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
	$sub_array = array();
	$sub_array[] = $row["S_Id"];
	$sub_array[] = $row["S_Name"];
	$sub_array[] = $row["S_Phone"];
	$sub_array[] = $row["S_Password"];
	$sub_array[] = $row["S_Username"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["S_Id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["S_Id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
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