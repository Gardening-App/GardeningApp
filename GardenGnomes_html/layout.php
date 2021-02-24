<<<<<<< HEAD
=======
<?php
include("css/header.php"); 
include("css/footer.php");
require("dbConnect.php");
require("callQuery.php");
?> 

>>>>>>> Cody
<html>
<head>

	<link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">
  <title>About page</title>
</head>
<?php
include("css/header.php"); 
?> 

<div id="pages">
    <h1>Garden layout designer</h1>
</div>
	

	
<body>

	<div id = 'designerWrapper'>
		
=======
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">
  <title>Designer page</title>
</head>
	
<body>
	<div id="pages">
		<h1>Garden layout designer</h1>
	</div>
	<div id = 'designerWrapper'>
			
>>>>>>> Cody
		<div id = 'designerLeft'>
			<span id = 'dimX'>60'</span>
			<canvas id = 'designerWindow' width = '600' height = '400'></canvas>
			<span id = 'dimY'>40'</span>
		</div>
		
		<div id = 'designerRight'>
			<h3>Controls:</h3>

<<<<<<< HEAD
			<form>
=======
			<form method = "post">
>>>>>>> Cody
				<label for="CropType">Crop Type:</label>
				<select id="cropType">
					<option value="Tomato">Tomato</option>
					<option value="Potato">Potato</option>
					<option value="Corn">Corn</option>
				</select><br><br>
				<input type = "button" id = "new" value = "New"><br><br>
<<<<<<< HEAD
				<input type = "button" id = "save" value = "Save"><br><br>	
				<textarea id="data" cols="30" rows="5"></textarea><br><br>
				<input type = "button" id = "load" value = "Load">
			</form>
			
=======
				<input type="text" id="cropName">
				<input type = "submit" name = "save" id = "save" value = "Save" return = "False"><br><br>	
				<select id="saveFile">
	<?php

		try {
			$query = "SELECT * FROM layout
				WHERE userId = 1";
			$errorMessage = "Error retrieving layouts";
			$layoutResult = callQuery($pdo, $query, $errorMessage);


			// Query through layouts associated with current user
			while ($row = $layoutResult->fetch()) {

				//Sub query to get all shapes for that layout
				$query = "SELECT * FROM shape
						WHERE layoutID = " . $row['layoutID'];
				$errorMessage = "Error retrieving shapes";
				$shapesResult = callQuery($pdo, $query, $errorMessage);

				$coords = "";
				$types = "";

				// Build shapes string to put in option tag
				while ($shapeRow = $shapesResult->fetch()) {
					$coords .= $shapeRow['x1'] . '#' . $shapeRow['y1'] . '#' . $shapeRow['x2'] . '#' . $shapeRow['y2'] . '#';
					$types .= $shapeRow['cropType'];
				}
				$shapesString = $coords . $types;

				echo "<option value = '$shapesString' sqlID = '$row[layoutID]'>$row[layoutName]</option>";
			}
		} catch(exception $e) {
			echo "<option value = '' sqlID = ''>Error connecting</option>";
		}
		
	?>
				</select>
				<input type = "button" id = "load" value = "Load">
				<input type = "button" id = "delete" value = "Delete">
				<br><br>
			</form>

>>>>>>> Cody
		</div>
	</div>

	<div id = 'designerInstructions'>
		<h3>Instructions</h3>
			<ul>
				<li>Click and drag to create crop</li>
				<li>Use buttons on right</li>
				<li>Press "D" to delete seleced crop</li>

			</ul>
<<<<<<< HEAD

		</div>
		
	

    <script src = "Js/jquery-3.5.1.min.js"></script>
		<script src = 'Js/designer.js'></script>
		<?php
include("css/footer.php"); 
?> 
=======
	
	</div>
		

	<script src = "Js/jquery-3.5.1.min.js"></script>
	<script src = 'Js/designer.js'></script>
	
>>>>>>> Cody
</body>
</html>
