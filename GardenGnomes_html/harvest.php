<?php
	require("dbConnect.php");
	require("callQuery.php");
	require("dbfunctions.php");

	if (!session_id()) {
		session_start();
	}

	// Log out if sent logOut
	if (isset($_POST['logOut'])) {
		unset($_SESSION['loggedIn']);
		$_SESSION['userID'] = 0;
	}


?> 
<html>
<head>
    <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/harvest.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">
  <title>Harvest page</title>
</head>

<div class="page-container">
<div class="content-wrapper">	
<body>
	<?php
include("css/header.php"); 

?> 

	<div id="harvest">
		<p>Harvest</p>
	<?php
		
		if (isset($_SESSION['loggedIn'])) {
			$userID = $_SESSION['userID'];
	?> 
		<div id="innerContent">
			<form id="harvestForm" userID="<?php echo($userID)?>">
				<label for="cropType">Crop Type:</label>
				<select id="cropType">
					<!-- Populate crops from db -->
<?php
	try {
				
		$query = "SELECT crop.name, crop.cropID, avg(poundsProduced/sqFeet) AS average FROM crop
				LEFT JOIN harvest ON crop.cropID = harvest.cropID
				GROUP BY cropID;";
		$errorMessage = "Error retrieving crops";
		$cropResult = callQuery($pdo, $query, $errorMessage);


		// Query through layouts associated with current user
		while ($row = $cropResult->fetch()) {
			echo "<option value = '$row[name]' cropID = '$row[cropID]' average = '$row[average]'>$row[name]</option>";	
			
		}

	} catch(exception $e) {
		echo "<option value = '' sqlID = ''>Error connecting</option>";
	}

?> 
				</select><br>
				<label for="fromLayout">Use saved layout?</label><br>
				<label for="no" class="yesNo">No:</label>
				<input type="radio" id="layoutNo" name="noYes" checked>
				<label for="yes" class="yesNo">Yes:</label>
				<input type="radio" id="layoutYes" name="noYes"><br>

				<div id="savedLayouts">
					<label for="selectLayout">Select layout:</label>
					<select id="layout">
<?php
	// Query through layouts associated with current user
	
	$query = "SELECT * FROM layout
		WHERE userId = $userID";
	$errorMessage = "Error retrieving layouts";
	$layoutResult = callQuery($pdo, $query, $errorMessage);

	while ($layoutRow = $layoutResult->fetch()) {
		$currentLayoutName = $layoutRow['layoutName'];
		$currentLayoutID = $layoutRow['layoutID'];
		//Start building option
		echo("<option");
		
		// Inner query to get areas
		$query = "SELECT cropID, 
		sum((x2 - x1) * (y2- y1)) / 10 AS area
		FROM gardengnomes.shape
		WHERE layoutID = $currentLayoutID
		GROUP BY cropID;";
		$errorMessage = "Error retrieving areas";
		$areaResult = callQuery($pdo, $query, $errorMessage);

		while ($areaRow = $areaResult->fetch()) {
			$currentCropID = $areaRow['cropID'];
			$currentCropArea = $areaRow['area'];

			echo(" $currentCropID = '$currentCropArea'");
		}
		echo(">$currentLayoutName</option>");
	}
?>
					</select><br>
					
				</div>

				<label for="squareFeet">Square feet: </label>
				<input name="squareFeet" id="squareFeet"></input><br>
				<label for="poundsProduced">Pounds produced: </label>
				<input name="poundsProduced" id="poundsProduced"></input><br>
				<input class="submit" type="submit" name="harvest" id = "harvestButton", value = "Harvest">
			</form>

			<div id="results">
				<div id = "resultsText">
					Results show here.
				</div>
				<div id = "resultsSave">
					<button type="button" id="saveButton" class="submit">Save</button> 
				</div>
			</div>
		</div>

			
<?php } else {
	echo("<label>Please log in to use this</label>");
	}?>
		
	</div>
				</div>

		<script src="Js/jquery-3.5.1.min.js"></script>
		<script src="Js/harvest.js"></script>
		<?php
include("css/footer.php"); 
?> 
</body>
</div>
</html>
