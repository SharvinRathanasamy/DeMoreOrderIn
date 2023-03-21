<?php 
    include ("connection.php");
	session_start();
if (isset($_SESSION['Staff_ID']) ) {
	//echo $_SESSION['Staff_ID'];
	$s=$_SESSION['Staff_ID'];

?>



<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="BookingHistorycss.css">

    <style>
        
    </style>
</head>
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
<h2> Records</h2>
</div>

<body>
<div class="row">   
<div class="section">

    <br>
        <div class="search">
            <i class="fa fa-search"></i><input type="search" id="hissch" name="hissch" class="hissch" onkeyup="search()" placeholder="Search">
            <select name="seaDB" id="seaDB" onchange="setSearch()">
            <option value="all" selected>Search By</option>
            <option value="BookID">Booking ID</option>
            <option value="ContNo">Contact No</option>
            </select>
        </div>
        <br><br>
     <div class="filtersearch">


     
      <form  method="POST">
  
        <select name="fill2" id="fill2" class="fill2"> 
            <option value="all" <?php echo (isset($_POST['fill2']) && $_POST['fill2'] =='all') ? 'selected' : ''; ?> >Pick-up Date</option>
            <option value="pickupAsc" <?php echo (isset($_POST['fill2']) && $_POST['fill2'] =='pickupAsc') ? 'selected' : ''; ?> >Pick-up Date Ascending</option>
            <option value="pickupDesc" <?php echo (isset($_POST['fill2']) && $_POST['fill2'] =='pickupDesc') ? 'selected' : ''; ?> >Pick-up Date Descending</option>
        </select>

          <select name="fill3" id="fill3" class="fill3"> 
            <option value="all" <?php echo (isset($_POST['fill3']) && $_POST['fill2'] =='all') ? 'selected' : ''; ?> >Booking Status</option>
            <option value="Complete" <?php echo (isset($_POST['fill3']) && $_POST['fill2'] =='Complete') ? 'selected' : ''; ?> >Complete</option>
            <option value="Cancel" <?php echo (isset($_POST['fill3']) && $_POST['fill2'] =='Cancel') ? 'selected' : ''; ?> >Cancel</option>
            <option value="Incomplete" <?php echo (isset($_POST['fill3']) && $_POST['fill2'] =='Incomplete') ? 'selected' : ''; ?> >Incomplete</option>
          </select>
			<input type='hidden' name='s_id' id="s_id" value='<?php echo  $s; ?>'>
          <button value="Submit" name="filter">Filter <i class="fa fa-filter"></i></button>

        </form>
 </div>
        <br>

        <div class="scrollbar" id="hist">
         <table>
            <thead>
                <tr class="header">
                    <th> BookingID </th>
                    <th> Customer Name </th>
                    <th> Contact Number </th>
                    <th> Pick-up Date </th>
                    <th> Pick-up Time </th>
                    <th> Booking Status </th>
                    <th class="opencol"> </th>
                </tr>
            </thead>

            <?php include'bookHistory.php' ?>

           </table>
        </div>
    </div>   
     </div>        

  <script>


        function search() {
          var input, filter, table, tr, td, i, j, seaV;
          input = document.getElementById("hissch");
          filter = input.value.toUpperCase();
          table = document.getElementById("hist");
          tr = table.getElementsByTagName("tr");
          seaV = setSearch();


            if(seaV == "BookID"){
                j = 0;
                }
            else if (seaV == "ContNo"){
                j = 2;
            }
    
          for (i = 0; i < tr.length; i++) {

  
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }

        function setSearch(){
            var seaValue;
            seaValue = document.getElementById("seaDB").value;
            return seaValue;
        } 

        </script>

<div class="footer">
  <p>De More Order-In Booking System Prototype &copy; 2022.</p>
</div>
</body>
</html>
<?php } ?>