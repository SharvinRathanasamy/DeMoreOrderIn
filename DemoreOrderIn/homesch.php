<?php
 require'connection.php';
    if(ISSET($_POST['filter'])){
		$pickup = $_POST['fill2'];
        $status = $_POST['fill3'];
		$s= $_POST['s_id'];
		
		if($pickup == "all" && $status == "all"){
			$sql = "SELECT B_Id, C_Name, C_Phone, B_PickupDate, B_PickupTime, B_Status FROM booking where B_PickupDate> DATE_SUB(NOW(), INTERVAL 0 DAY)";
			$result = $conn->query($sql);
			
			for($i = 0; $row = $result->fetch_assoc(); $i++){
				echo"<tbody><tr>";
				echo"<td>".$row['B_Id']."</td>";
				echo"<td>".$row['C_Name']."</td>";
				echo"<td>".$row['C_Phone']."</td>";
				echo"<td>".$row['B_PickupDate']."</td>";
				echo"<td>".$row['B_PickupTime']."</td>";
				echo"<td>".$row['B_Status']."</td>";
				echo"<td><td><form action='openid.php' method='post'>
			 <input type='hidden' name='id_b' id='id_b' value='".$row['B_Id']."'>
				<input type='hidden' name='sff_b' id='sff_b' value='".$s."'>
			<td><input type='submit' name='open' value='Open'></td>
			</form></td>";
				echo"</tr></tbody>";
			}
		}
		
		else if($pickup == "pickupAsc" && $status == "all"){
		
			$sql = "SELECT B_Id, C_Name, C_Phone, B_PickupDate, B_PickupTime, B_Status FROM booking where B_PickupDate> DATE_SUB(NOW(), INTERVAL 0 DAY) ORDER BY B_PickupDate ASC ";
			$result = $conn->query($sql);

			for($i = 0; $row = $result->fetch_assoc(); $i++){
				echo"<tbody>";
				echo"<tr>";
				echo"<td>".$row['B_Id']."</td>";
				echo"<td>".$row['C_Name']."</td>";
				echo"<td>".$row['C_Phone']."</td>";
				echo"<td>".$row['B_PickupDate']."</td>";
				echo"<td>".$row['B_PickupTime']."</td>";
				echo"<td>".$row['B_Status']."</td>";
				echo"<td><td><form action='openid.php' method='post'>
			 <input type='hidden' name='id_b' id='id_b' value='".$row['B_Id']."'>
				<input type='hidden' name='sff_b' id='sff_b' value='".$s."'>
			<td><input type='submit' name='open' value='Open'></td>
			</form></td>";
				echo"</tr></tbody>";
			}
		}
		
		else if($pickup == "pickupDesc" && $status == "all"){
		
			$sql = "SELECT B_Id, C_Name, C_Phone, B_PickupDate, B_PickupTime, B_Status FROM booking where B_PickupDate> DATE_SUB(NOW(), INTERVAL 0 DAY) ORDER BY B_PickupDate DESC";
			$result = $conn->query($sql);

			for($i = 0; $row = $result->fetch_assoc(); $i++){
				echo"<tbody>";
				echo"<tr>";
				echo"<td>".$row['B_Id']."</td>";
				echo"<td>".$row['C_Name']."</td>";
				echo"<td>".$row['C_Phone']."</td>";
				echo"<td>".$row['B_PickupDate']."</td>";
				echo"<td>".$row['B_PickupTime']."</td>";
				echo"<td>".$row['B_Status']."</td>";
				echo"<td><td><form action='openid.php' method='post'>
			 <input type='hidden' name='id_b' id='id_b' value='".$row['B_Id']."'>
				<input type='hidden' name='sff_b' id='sff_b' value='".$s."'>
			<td><input type='submit' name='open' value='Open'></td>
			</form></td>";
				echo"</tr></tbody>";
			}
		}
		
		else if($pickup == "pickupAsc" && $status != "all"){
		
			$sql = "SELECT B_Id, C_Name, C_Phone, B_PickupDate, B_PickupTime, B_Status FROM booking WHERE B_PickupDate> DATE_SUB(NOW(), INTERVAL 0 DAY) AND `B_Status`= '$status' ORDER BY B_PickupDate ASC";
			$result = $conn->query($sql);

			for($i = 0; $row = $result->fetch_assoc(); $i++){
				echo"<tbody>";
				echo"<tr>";
				echo"<td>".$row['B_Id']."</td>";
				echo"<td>".$row['C_Name']."</td>";
				echo"<td>".$row['C_Phone']."</td>";
				echo"<td>".$row['B_PickupDate']."</td>";
				echo"<td>".$row['B_PickupTime']."</td>";
				echo"<td>".$row['B_Status']."</td>";
				echo"<td><td><form action='openid.php' method='post'>
			 <input type='hidden' name='id_b' id='id_b' value='".$row['B_Id']."'>
				<input type='hidden' name='sff_b' id='sff_b' value='".$s."'>
			<td><input type='submit' name='open' value='Open'></td>
			</form></td>";
				echo"</tr></tbody>";
			}
		}
		
		else if($pickup == "pickupDesc" && $status != "all"){
		
			$sql = "SELECT B_Id, C_Name, C_Phone, B_PickupDate, B_PickupTime, B_Status FROM booking WHERE B_PickupDate> DATE_SUB(NOW(), INTERVAL 0 DAY) AND `B_Status`= '$status' ORDER BY B_PickupDate DESC";
			$result = $conn->query($sql);

			for($i = 0; $row = $result->fetch_assoc(); $i++){
				echo"<tbody>";
				echo"<tr>";
				echo"<td>".$row['B_Id']."</td>";
				echo"<td>".$row['C_Name']."</td>";
				echo"<td>".$row['C_Phone']."</td>";
				echo"<td>".$row['B_PickupDate']."</td>";
				echo"<td>".$row['B_PickupTime']."</td>";
				echo"<td>".$row['B_Status']."</td>";
				echo"<td><td><form action='openid.php' method='post'>
			 <input type='hidden' name='id_b' id='id_b' value='".$row['B_Id']."'>
				<input type='hidden' name='sff_b' id='sff_b' value='".$s."'>
			<td><input type='submit' name='open' value='Open'></td>
			</form></td>";
				echo"</tr></tbody>";
			}
		}
		
		else if($pickup == "all" && $status != "all"){
		
			$sql = "SELECT B_Id, C_Name, C_Phone, B_PickupDate, B_PickupTime, B_Status FROM booking WHERE B_PickupDate> DATE_SUB(NOW(), INTERVAL 0 DAY) AND `B_Status`= '$status'";
			$result = $conn->query($sql);

			for($i = 0; $row = $result->fetch_assoc(); $i++){
				echo"<tbody>";
				echo"<tr>";
				echo"<td>".$row['B_Id']."</td>";
				echo"<td>".$row['C_Name']."</td>";
				echo"<td>".$row['C_Phone']."</td>";
				echo"<td>".$row['B_PickupDate']."</td>";
				echo"<td>".$row['B_PickupTime']."</td>";
				echo"<td>".$row['B_Status']."</td>";
				echo"<td><td><form action='openid.php' method='post'>
			 <input type='hidden' name='id_b' id='id_b' value='".$row['B_Id']."'>
				<input type='hidden' name='sff_b' id='sff_b' value='".$s."'>
			<td><input type='submit' name='open' value='Open'></td>
			</form></td>";
				echo"</tr></tbody>";
			}
		}
		
	}
	
	else{
		$sql = "SELECT B_Id, C_Name, C_Phone, B_PickupDate, B_PickupTime, B_Status FROM booking where B_PickupDate> DATE_SUB(NOW(), INTERVAL 0 DAY)";
        $result = $conn->query($sql);
		
        for($i = 0; $row = $result->fetch_assoc(); $i++){
			echo"<tbody><tr>";
			echo"<td>".$row['B_Id']."</td>";
			echo"<td>".$row['C_Name']."</td>";
			echo"<td>".$row['C_Phone']."</td>";
			echo"<td>".$row['B_PickupDate']."</td>";
			echo"<td>".$row['B_PickupTime']."</td>";
			echo"<td>".$row['B_Status']."</td>";
			echo"<td><td><form action='openid.php' method='post'>
			 <input type='hidden' name='id_b' id='id_b' value='".$row['B_Id']."'>
				<input type='hidden' name='sff_b' id='sff_b' value='".$s."'>
			<td><input type='submit' name='open' value='Open'></td>
			</form></td>";
			echo"</tr></tbody>";
		}
	}
?>