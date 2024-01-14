
<?php
include "connect_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    	$tauserid = $_POST['tauserid'];
    	$firstname = $_POST['firstname'];
    	$lastname = $_POST['lastname'];
    	$studentnum = $_POST['studentnum'];
    	$degreetype = $_POST['degreetype'];
    	$image = $_POST['image'];

    	$loves = $_POST['lcourses'];
    	$hates = $_POST['hcourses'];

    	$query = "INSERT INTO ta VALUES
                ('$tauserid',
                '$firstname',
                '$lastname',
                '$studentnum',
                '$degreetype',
                '$image')";

    	$check_id_studentnum = "SELECT * FROM ta WHERE
                            tauserid = '$tauserid' OR
                            studentnum = '$studentnum'";

    	$check_result = mysqli_query($connection, $check_id_studentnum);

    	if (mysqli_num_rows($check_result) > 0) {
     
		echo '<script type="text/javascript">';
		echo 'alert("tauserid or student number already exists, enter different value");';
		echo 'window.location.href = "insert_form.php";';
		echo '</script>';
	
		exit();
    	} 
	
	else {
        	$result = mysqli_query($connection, $query);

        	if ($result) {
            		if (!empty($loves)) {
            	    		foreach ($loves as $love) {
            	       			$lcoursenum_query = "SELECT coursenum FROM course WHERE coursename = '$love'";
               		     		$lcoursenum_query_result = mysqli_query($connection, $lcoursenum_query);

                    // Fetch the result to get the actual value
                    			$lcoursenum_result = mysqli_fetch_assoc($lcoursenum_query_result)['coursenum'];

                    			$query_loves = "INSERT INTO loves VALUES ('$tauserid', '$lcoursenum_result')";
                    			$query_loves_result = mysqli_query($connection, $query_loves);

                    			if (!$query_loves_result) {
			    
			  			echo "Error inserting loves information: " . mysqli_error($connection);
                      	  			exit();
                    			}
                		}
            		}

            		if (!empty($hates)) {
				
				foreach ($hates as $hate) {
                    			$hcoursenum_query = "SELECT coursenum FROM course WHERE coursename = '$hate'";
                    			$hcoursenum_query_result = mysqli_query($connection, $hcoursenum_query);

                    			$hcoursenum_result = mysqli_fetch_assoc($hcoursenum_query_result)['coursenum'];

                    			$query_hates = "INSERT INTO hates VALUES ('$tauserid', '$hcoursenum_result')";
                    			$query_hates_result = mysqli_query($connection, $query_hates);

                    			if (!$query_hates_result) {
						
						echo "Error inserting hates information: " . mysqli_error($connection);
                        			exit();
                    			}
                		}
            		}

            		header("Location: main_menu.php");
            		
			exit();
        	} 
		
		else {
            	
			echo "Error: " . mysqli_error($connection);
        	}
    	}
	
	mysqli_close($connection);
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
<title>Insert Ta Form</title>

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

	<h1> Insert Ta form </h1>

	<form class="" action="" method="post" action="">
	
		<label for =""> tauserid </label>
		<input type = "text" name = "tauserid" required value="">

		<label for =""> firstname </label>
		<input type = "text" name = "firstname" required value="">

		<label for =""> lastname </label>
		<input type = "text" name = "lastname" required value="">

		<label for =""> studentnum </label>
		<input type = "number" name = "studentnum" required value="">
		
		<br><br>
		<label for =""> degreetype </label>
			<br>
			<input type = "radio" name = "degreetype" value = "Masters" required> Masters
			<input type = "radio" name = "degreetype" value = "PhD"> PhD


		<br><br>	
		<label for =""> image url </label>
			
		<input type = "text" name = "image_url" value="">


		<?php
			
			$query_course = "SELECT coursename FROM course";
        		$query_course_result = mysqli_query($connection, $query_course);

        		$courses = [];
        		while($row = mysqli_fetch_assoc($query_course_result)) {

                		$courses[] = $row;
        		}
		
			echo "<br><br><label for =''> loves </label><br>";
	
			foreach($courses as $row) {
				
				echo "<input type='checkbox' name = 'lcourses[]' value='".
				$row['coursename'] . "'>" . $row['coursename']; 
			}
				
			echo "<br><br><label for =''> hates </label><br>";
	
			foreach($courses as $row) {
				
				echo "<input type='checkbox' name = 'hcourses[]' value='".
				$row['coursename'] . "'>" . $row['coursename']; 
			}
				
		?>

		<br><br>	
		<button type="submit" name="submit">Submit</button>

	</form>


</body>
</html>
