<?php 
session_start(); 
include "connection.php";


if(isset($_POST["open"])){

$b_id =$_POST['id_b'];
$s_id =$_POST['sff_b'];


echo $b_id;
echo $s_id ;
	
	$_SESSION['Bkk_id'] = $b_id;
									 $_SESSION['Staff_ID'];
									 header('location: details.php');			


}

else if(isset($_POST["edit"])){

$b_id =$_POST['id_b'];
$s_id =$_POST['sff_b'];


echo $b_id;
echo  $_SESSION['Staff_ID'] ;
	
	$_SESSION['Bkk_id'] = $b_id;
									 $_SESSION['Staff_ID'];
									 header('location: editable_details.php');		


}

if(isset($_POST["back"])){

$b_id =$_POST['id_b'];
$s_id =$_POST['sff_b'];


echo $b_id;
echo $s_id ;
	
	$_SESSION['Bkk_id'] = $b_id;
									 $_SESSION['Staff_ID'];
									 header('location: details.php');			


}


?>