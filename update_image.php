
<?php
	include "connect_db.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$tauserid = $_POST['selected_ta'];

		$image_url = $_POST['image_url'];
	
		$query = "UPDATE ta SET image = '$image_url' WHERE tauserid = '$tauserid'";

		$query_result = mysqli_query($connection, $query);
	
		if (!$query_result) {
			
			echo "Error updating ta image: " . $mysqli_error($connection);

			exit();
		}
	
		header("Location: index_main.php");

		exit();
	
	}

?>


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

<style>

                body {
                        align-items:center;
                        text-align:center;
                }

        </style>

<title>Insert Ta Form</title>

</head>

<body>


	<a href="main_menu.php">

                <button> Back to main menu </button>

        </a>

	<h1> Update Image URL </h1>

	<form class="" action="" method="post">
		
		<label for =""> Select a TA: </label>

		<?php
	
                        $query_tauserid = "SELECT tauserid FROM ta";

			$query_tauserid_result = mysqli_query($connection, $query_tauserid);

                        $tauserids = [];
			
			while($row = mysqli_fetch_assoc($query_tauserid_result)) {

                                $tauserids[] = $row;
                        }

			foreach ($tauserids as $tauserid) {

				echo "<input type='radio' name='selected_ta' value='".$tauserid['tauserid'] . "'>" . $tauserid['tauserid'];						}

                ?>	
		
		<br><br>	
		
		<label for =""> Updated Image URL </label>
		
		<input type = "text" name = "image_url" value="">

		<br><br>

		<button type = "submit" name = "update"> Update</button>

</body>
