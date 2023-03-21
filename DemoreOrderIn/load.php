<?php
include("connection.php");
//load.php

$data = array();

$query = "SELECT * FROM booking ORDER BY B_Id";

$statement = $connection->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["B_Id"],
  'title'   => $row["B_Id"],
  'start'   => $row["B_PickupDate"],
  'end'   => $row["B_PickupDate"]
 );
}

echo json_encode($data);

?>