<?php
if (!session_id()) {
	session_start();
}

require("dbConnect.php");
require("callQuery.php");
?> 

<html>
<head>

	<link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">
  <title>Designer page</title>
</head>
<?php
include("css/header.php");
?>
	  <div class="page-container">
<div class="content-wrapper">
<body>
	<div id="pages">
		<h1>Garden layout designer</h1>
	</div>
	<div id = 'designerWrapper'>
			
		<div id = 'designerLeft'>
			<span id = 'dimX'>60'</span>
			<canvas id = 'designerWindow' width = '600' height = '400'></canvas>
			<span id = 'dimY'>40'</span>
		</div>
		
		<div id = 'designerRight'>
			<h3>Controls:</h3>

			<form method = "post">
				<label for="CropType">Crop Type:</label>
				<select id="cropType">
				<?php
	try {
				
		$query = "SELECT * FROM crop";
		$errorMessage = "Error retrieving crops";
		$cropResult = callQuery($pdo, $query, $errorMessage);


		// Query through layouts associated with current user
		while ($row = $cropResult->fetch()) {
			echo "<option value = '$row[name]' cropID = '$row[cropID]' cropAbbr='$row[abbr]'>$row[name]</option>";	
			
		}

	} catch(exception $e) {
		echo "<option value = '' sqlID = ''>Error connecting</option>";
	}

?> 
				</select><br><br>
				<input type = "button" id = "new" value = "New"><br><br>
				<input type="text" id="cropName">
				<input type = "submit" name = "save" id = "save" value = "Save" return = "False"><br><br>	
				<select id="saveFile">
	<?php
		// Check to see if user is logged in
		if (isset($_SESSION['loggedIn'])) {

			try {

				// Query through layouts associated with current user
				$userID = $_SESSION['userID'];
				$query = "SELECT * FROM layout
					WHERE userId = $userID";
				$errorMessage = "Error retrieving layouts";
				$layoutResult = callQuery($pdo, $query, $errorMessage);

				while ($row = $layoutResult->fetch()) {

					//Sub query to get all shapes for that layout
					$query = "SELECT * FROM shape
							LEFT JOIN crop ON shape.cropID = crop.cropID
							WHERE layoutID = " . $row['layoutID'];
					$errorMessage = "Error retrieving shapes";
					$shapesResult = callQuery($pdo, $query, $errorMessage);

					$coords = "";
					$cropIDs = "";
					$cropAbbrs = "";

					// Build strings to put in option tag
					while ($shapeRow = $shapesResult->fetch()) {
						$coords .= $shapeRow['x1'] . '#' . $shapeRow['y1'] . '#' . $shapeRow['x2'] . '#' . $shapeRow['y2'] . '#';
						$cropIDs .= $shapeRow['cropID'] . '#';
						$cropAbbrs .= $shapeRow['abbr'] . '#';
					}

					// Build option
					echo "<option value = '$coords' sqlID = '$row[layoutID]' cropIDs = '$cropIDs' cropAbbrs = '$cropAbbrs'
					width='$row[layoutWidth]' height='$row[layoutHeight]'>$row[layoutName]</option>";
				}

			} catch(exception $e) {
				echo "<option value = '' sqlID = ''>Error connecting</option>";
			}

		} else { //User is not logged in
			echo "<option value = '' sqlID = ''>Please log in</option>";
		}
		
	?>
				</select>
				<input type = "button" id = "load" value = "Load">
				<input type = "button" id = "delete" value = "Delete">
				<br><br>
			</form>

		</div>
	</div>

	<div id = 'designerInstructions'>
		<h3>Instructions</h3>
			<ul>
				<li>Click and drag to create crop</li>
				<li>Use buttons on right</li>
				<li>Press "D" to delete seleced crop</li>

			</ul>
	
	</div>
		
	<!-- Get post data -->
	<script type="text/javascript">
		var userID;
<?php if (isset($_SESSION['userID'])) {?>
		userID="<?php echo $_SESSION['userID'];?>";
<?php }?> 
    </script>
	<script src = "Js/jquery-3.5.1.min.js"></script>
	<script src = 'Js/designer.js'></script>
 </div>
  <?php
  include("css/footer.php");

  ?>
</body>
</div>
</html>
