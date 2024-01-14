<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">


<style>
	
	h1 {
		display: flex;	
		margin-top; 20px;
		justify-content: center;
	}

	body {
         	justify-content: center;
          	align-items: center;
           	height: 100vh;
	    	margin: 100px 100px;
	}


        table {
            	margin-top: 20px; /* Adjust the top margin as needed */
	    
		width: 80%; /* Adjust the width as needed */
        }
</style>




<script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script defer src = "https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>	
<script defer src = "https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script defer src = "script.js"></script> 

<title>Display TAs</title>

</head>


<body>	
	
	<a href="main_menu.php">

		<button> Back to main menu </button>

	</a>
	
	<h1> TA Info </h1>
	

	<?php

	include "connect_db.php";

		$query = "SELECT * FROM ta";
	
		$result = mysqli_query($connection,$query);
	
		if (!$result) {
		
			die("databases query failed.");
		}

	?>

	<table id="example" class="table table-striped" style="width:100%">

    	<thead>
        	<tr>
           	 	<th>tauserid</th>
            		<th>firstname</th>
            		<th>lastname</th>
            		<th>studentnum</th>
            		<th>degreetype</th>
        	</tr>
    	</thead>

	<?php

		while ($row = mysqli_fetch_assoc($result)) {

			echo "<tr>";
		
			echo "<td><a href='ta_info.php?tauserid=" . 
			$row["tauserid"] . "&firstname=" . 
			$row["firstname"] . "&lastname=" . 
			$row["lastname"] . "&studentnum=" . 
			$row["studentnum"] . "&degreetype=" . 
			$row["degreetype"] . "'>" . 
			$row["tauserid"] . "</a></td>";
		
    			echo "<td>" . $row["firstname"] . "</td>";
    			echo "<td>" . $row["lastname"] . "</td>";
			echo "<td>" . $row["studentnum"]. "</td>";
			echo "<td>" . $row["degreetype"]. "</td>";	
			echo "</tr>";
		}

		mysqli_free_result($result);

	?>

</body>
</html>




