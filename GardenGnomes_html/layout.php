<?php
	require("dbConnect.php");
	require("callQuery.php");
?>

<html>
<head>
		<link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About page</title>
</head>
	
<div class="navWrapper">
<div class="social-links">
    <ul class="d-flex">
      <li><a><i class="fa fa-facebook"></i></a></li>
      <li><a><i class="fa fa-youtube"></i></a></li>
      <li><a><i class="fa fa-instagram"></i></a></li>
       
    </ul>
  </div>
<div class="navBar">
    
    
    <ul>
        <li><a href="about.html">About</a></li>
        <li><a href="layout.html">Layout</a></li>
        <li><a href="shop.html">Shop</a></li>
         <li><a href="social.php">Social</a></li>
        <li></ul>
</div>


<p id="name">The Gardening Gnome <img src="images/gnome.webp" width="3%"></p>
<p id="slogan">A community for gardeners.</p>
</div>

<div id="pages">
    <h1>Garden layout designer</h1>
</div>
	

	
<body>

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
					<option value="Tomato">Tomato</option>
					<option value="Potato">Potato</option>
					<option value="Corn">Corn</option>
				</select><br><br>
				<input type = "button" id = "new" value = "New"><br><br>
				<input type="text" id="cropName">
				<input type = "submit" name = "save" id = "save" value = "Save" return = "False"><br><br>	
				<select id="saveFile">
<?php
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
		
	

    <script src = "Js/jquery-3.5.1.min.js"></script>
	<script src = 'Js/designer.js'></script>

<?php

	if(isset($_POST['save'])) {
		echo "Clicky clicky click!";
	} else {
		echo "No clicky:(";
	}
?> 

</body>
<footer>
	<img src="images/gnome.webp">
	<nav>
		<a href="about.html">About</a>
		<a href="layout.html">Layout</a>
		<a href="shop.html">Shop</a>
		<a href="social.html">Social</a>
	</nav>
</footer>
</html>
