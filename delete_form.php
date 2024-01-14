<?php
include "connect_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deletions = $_POST['tas'];

    if (!empty($deletions)) {
        foreach ($deletions as $deletion) {

            $query = "DELETE FROM ta WHERE tauserid = '$deletion'";
            $query_result = mysqli_query($connection, $query);

            if (!$query_result) {
                echo "Error deleting: " . mysqli_error($connection);
            }
        }

        header("Location: main_menu.php");
        exit();
    }
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

    <title>Delete TA Form</title>

	<style> 

		body {
			align-items:center;
			text-align:center;	
		}

	</style>

</head>
<body>


	<a href="main_menu.php">

                <button> Back to main menu </button>

        </a>	
    <h1>Delete TA Form</h1>

	<form action="" method="post" onsubmit="return confirmDelete();">

		<?php
   			$query_course = "SELECT tauserid FROM ta";
  			$query_course_result = mysqli_query($connection, $query_course);
    			$courses = [];

    			while ($row = mysqli_fetch_assoc($query_course_result)) {
        			$courses[] = $row;
    			}	

		
    			echo "<br><br><label for=''>TA</label><br>";

    			foreach ($courses as $row) {
        			echo "<input type='checkbox' name='tas[]' value='" . $row['tauserid'] . "'>" . $row['tauserid'];
    			}

    		?>

		<br><br>
		<button type="submit" name="submit">Delete</button>
	</form>


	<script>
        	function confirmDelete() {
            		return confirm("Are you sure you want to delete?");
        	}
    	</script>

</body>
</html>

