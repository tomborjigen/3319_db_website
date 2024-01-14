
<?php

include "connect_db.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {		

		$tauserid = $_POST['selected_ta'];

		$coid = $_POST['selected_offer'];

		$hours = $_POST['number_of_hours']; 

		$query = "INSERT INTO hasworkedon VALUES ('$tauserid','$coid','$hours')";	

		$check_assigned = "SELECT * FROM hasworkedon WHERE tauserid = '$tauserid' and
						coid = '$coid'";

		$check_assigned_result = mysqli_query($connection, $check_assigned);

		if (mysqli_num_rows($check_assigned_result) > 0) {

         	       	echo '<script type="text/javascript">';
         	       	echo 'alert("tauserid already assigned to coid");';
                	echo 'window.location.href = "assign_offering.php";';
                	echo '</script>';

               	 	exit();
        	}

		$query_result = mysqli_query($connection, $query);

		if (!$query_result) {

			echo "Error inserting values: " . $mysqli_error($connection);

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

		form {

			align-items:center;
			tex-align:center;
		}

		table {
            		border-collapse: collapse;
            		width: 40%; /* Adjust the width as needed */
            		margin: auto; /* Center-align the table within its container */
            		margin-top: 20px; /* Add some space between the table and other elements */
        	}

        </style>

<title>Working Page please</title>

</head>

<body> 
	<a href="main_menu.php">

                <button> Back to main menu </button>

        </a>	
	
	<h1> Assign TA to Course Offer </h1>

	<form class="" action="" method="post">

		<label for=""> Select a TA: </label>
	
		<?php

                        $query_tauserid = "SELECT tauserid FROM ta";

                        $query_tauserid_result = mysqli_query($connection, $query_tauserid);

                        $tauserids = [];

                        while($row = mysqli_fetch_assoc($query_tauserid_result)) {

                                $tauserids[] = $row;
                        }

                        foreach ($tauserids as $tauserid) {

				echo "<input type='radio' name='selected_ta' 
					value='".$tauserid['tauserid'] . "' required>" . 
					$tauserid['tauserid'];
			}

                ?>

		<br><br>
		<label for=""> Select course offering </label>

		<?php

                        $query_course_offer = "SELECT * from courseoffer";

                        $query_course_offer_result = mysqli_query($connection, $query_course_offer);

                        $offers = [];

                        while($row = mysqli_fetch_assoc($query_course_offer_result)) {

                                $offers[] = $row;
                        }

                ?> 

		<table border="1">
			
			<thead>
        	    	
			<tr>
				
				<th>select</th>
				
				<th>coid</th>
				
				<th>numstudent</th>
				
				<th>term</th>
				
				<th>year</th>
				
				<th>whichcourse</th>
			
			</tr>
			
			</thead>
				
				<tbody>

				<?php
			
					foreach ($offers as $offer) {
    					echo '<tr>';
					echo '<td><input type="radio" name="selected_offer" 
						value="' . $offer['coid'] . '" required ></td>';
    					echo '<td>' . $offer['coid'] . '</td>';
    					echo '<td>' . $offer['numstudent'] . '</td>';
    					echo '<td>' . $offer['term'] . '</td>';
    					echo '<td>' . $offer['year'] . '</td>';
    					echo '<td>' . $offer['whichcourse'] . '</td>';
    					echo '</tr>';
					
					}
				?>

				</tbody>
    		</table>
		
		<br>

		<label for=""> Number of hours </label>

		<input type = 'text' name = 'number_of_hours' value="" required>

    		<button type="submit" name="submit">Submit</button>

	</form>	

</body>

</html>


