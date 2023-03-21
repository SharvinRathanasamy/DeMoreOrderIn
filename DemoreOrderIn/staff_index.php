<?php
session_start();
if (isset($_SESSION['Staff_ID']) ) {
	//echo $_SESSION['Staff_ID'];
?>

<html>
	<head>
	<title>Staff Management</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<link href="staff_css.css" type="text/css" rel="stylesheet" />
	
	</head>
	<body>
	<div class="header">
  <h1>DE MORE ORDER-IN BOOKING SYSTEM</h1> 
</div>

<div class="topnav">
  <a href="home.php">BACK</a>
</div>
<div class = "row">
<h2> Staff Management</h2>
</div>
<div class = "row">			
<div class="section">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">Staff Id</th>
							<th width="25%">Name</th>
							<th width="25%">Phone</th>
							<th width="25%">Password</th>
							<th width="25%">Username</th>
							<th width="10%">Edit</th>
							<th width="10%">Delete</th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
		
		<div class="footer">
   <p>De More Order-In Booking System Prototype &copy; 2022.</p>
</div>
	</body>
</html>

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
	
		<form method="post" id="item_form" enctype="multipart/form-data">
		
			<div class="modal-content">
			
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Staff</h4>
				</div>
				
				
				<div class="modal-body">
				
				
					<label>Staff Name</label>
					<input type="text" name="st_name" id="st_name" class="form-control" required />
					<br />
					
					<label>Staff Phone Number</label>
					<input type="tel" name="st_phn" id="st_phn" class="form-control" pattern="[6][0][1][0-9]{7-8}" required />
					<br />
					
					<label>Password</label>
					<input type="text" name="st_pass" id="st_pass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$&+,:;=?@#|'<>.^*()%!-]).{8,12}" required />
					<br />
					
					<label>Username</label>
					<input type="text" name="st_uname" id="st_uname" class="form-control" minlength="5" maxlength="12" required />
					
				</div>
				
				
				
				<div class="modal-footer">
					<input type="hidden" name="item_id" id="item_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				
				
			</div>
		</form>
		
		
		
	</div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#item_form')[0].reset();
		$('.modal-title').text("Add Staff");
		$('#action').val("Add");
		$('#operation').val("Add");
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"staff_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[1,2,3,4,5,6],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#item_form', function(event){
		event.preventDefault();
		var st_name = $('#st_name').val();
		var st_phn = $('#st_phn').val();
		var st_pass = $('#st_pass').val();
		var st_uname = $('#st_uname').val();
		
			$.ajax({
				url:"staff_insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#item_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		
	});
	
	$(document).on('click', '.update', function(){
		var item_id = $(this).attr("id");
		$.ajax({
			url:"staff_fetch_single.php",
			method:"POST",
			data:{item_id:item_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#st_name').val(data.st_name);
				$('#st_phn').val(data.st_phn);
				$('#st_pass').val(data.st_pass);
				$('#st_uname').val(data.st_uname);
				$('.modal-title').text("Edit Staff");
				$('#item_id').val(item_id);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var item_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"staff_delete.php",
				method:"POST",
				data:{item_id:item_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
</script>

<?php } ?>