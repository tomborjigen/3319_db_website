<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Menu</title>
    <style>

	body {
    		font-family: Arial, sans-serif;
    		background-color: #f4f4f4;
    		display: flex;
    		flex-direction: column;
    		align-items: center;
    		justify-content: center;
    		min-height: 100vh;
    		margin: 0;
    		padding: 0;
	}

	body > * {
    		margin-bottom: 10px; /* Adjust the value as needed */
	}


        h1 {
            color: #333;
        }

        button {
            background-color: purple;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: darkpurple;
        }
    </style>
</head>
<body>

    <h1>Main Menu</h1>

    <a href="index_main.php">
        <button>View TA table</button>
    </a>

    <a href="insert_form.php">
        <button class="button">Insert new TA</button>
    </a>

    <a href="delete_form.php">
        <button class="button">Delete TA</button>
    </a>

    <a href="update_image.php">
        <button class="button">Update TA image</button>
    </a>

    <a href="assign_offering.php">
        <button class="button">Assign TA to offering</button>
    </a>

</body>
</html>
