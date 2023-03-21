<?php
session_start();
if (isset($_SESSION['Staff_ID']) ) {
	//echo $_SESSION['Staff_ID'];
?>
<html>
	<head>
	<title>Manage Item</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="item_css.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
	<div class="header">
  <h1>DE MORE ORDER-IN BOOKING SYSTEM</h1> 
</div>

<div class="topnav">
 <a href="home.php">Home</a>
  <a href="BookingHistory.php">History</a>
  <a href="item_index.php">Item Management</a>
  <a href="logout.php">LogOut</a>
</div>
<div class = "row">
<h2> Item Management</h2>
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
							<th width="5%">Code</th>
							<th width="25%">Name</th>
							<th width="25%">Image</th>
							<th width="35%">Description</th>
							<th width="25%">Price</th>
							<th width="25%">Category</th>
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
					<h4 class="modal-title">Add Item</h4>
				</div>
				
				
				<div class="modal-body">
				
				
					<label>Item Name</label>
					<input type="text" name="item_name" id="item_name" class="form-control" required />
					<br />
					
					<label>Description</label>
					<textarea rows = "2" cols = "50" name = "item_desc" id="item_desc" class="form-control" placeholder="Description" required></textarea>
					<br />
					
					<label>Price</label>
					<input type="number" min="0.00" max="10000.00" name="item_price" id="item_price" class="form-control" required />
					<br />
					
					<label>Category</label>
					<select name="item_categ" id="item_categ" class="form-control" >
								  <option value="Cake">Cake</option>
								  <option value="Bread">Bread</option>
								  <option value="Cookies">Cookies</option>
								  <option value="Others">Others</option>
					</select>
					<br />
					
					<label>Select User Image</label>
					<input type="file" name="item_image" id="item_image" />
					<span id="item_uploaded_image"></span>
					
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
		$('.modal-title').text("Add Item");
		$('#action').val("Add");
		$('#operation').val("Add");
		$('#item_uploaded_image').html('');
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"item_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0,2,3,6,7],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#item_form', function(event){
		event.preventDefault();
		var itemName = $('#item_name').val();
		var itemDesc = $('#item_desc').val();
		var itemPrice = $('#item_price').val();
		var itemCategory = $('#item_categ').val();
		var extension = $('#item_image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Invalid Image File");
				$('#item_image').val('');
				return false;
			}
		}	
		if(itemName != '' && itemPrice != '')
		{
			$.ajax({
				url:"item_insert.php",
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
		}
		else
		{
			alert("Both Fields are Required");
		}
	});
	
	$(document).on('click', '.update', function(){
		var item_id = $(this).attr("id");
		$.ajax({
			url:"item_fetch_single.php",
			method:"POST",
			data:{item_id:item_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#item_name').val(data.item_name);
				$('#item_desc').val(data.item_desc);
				$('#item_price').val(data.item_price);
				$('#item_categ').val(data.item_categ);
				$('.modal-title').text("Edit Item");
				$('#item_id').val(item_id);
				$('#item_uploaded_image').html(data.I_Image);
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
				url:"item_delete.php",
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
