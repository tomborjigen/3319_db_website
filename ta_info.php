
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script defer src = "https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer src = "https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script defer src = "script.js"></script>

<title>Working Page please</title>

</head>

<body>

	<a href="main_menu.php">

                <button> Back to main menu </button>

        </a>

<h1> TA info </h1>

<?php

include "connect_db.php";

$tauserid = $_GET['tauserid'];

$query = "SELECT * FROM ta WHERE tauserid = '$tauserid'";
$result = mysqli_query($connection, $query);

if (!$result) {
	
	die("Database query failed.");
}

$row = mysqli_fetch_assoc($result);

$image = $row['image'];

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

	echo "<tr>";

	echo "<tr>";
	echo "<td>" . $row["tauserid"] . "</td>";		
	echo "<td>" . $row["firstname"] . "</td>";
	echo "<td>" . $row["lastname"] . "</td>";	
	echo "<td>" . $row["studentnum"]. "</td>";
       	echo "<td>" . $row["degreetype"]. "</td>";
        echo "</tr>";


	$image_url = $row["image"];

	if ($image_url === null) {
		
		$image_url = "https://i.kym-cdn.com/entries/icons/facebook/000/034/213/cover2.jpg";
	}
	
	echo "<td><img src='$image_url' alt='Image'></td>"; 

?>



</body>
