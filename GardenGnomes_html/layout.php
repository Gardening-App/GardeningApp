<html>
<head>

	<link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
		
		<div id = 'designerLeft'>
			<span id = 'dimX'>60'</span>
			<canvas id = 'designerWindow' width = '600' height = '400'></canvas>
			<span id = 'dimY'>40'</span>
		</div>
		
		<div id = 'designerRight'>
			<h3>Controls:</h3>

			<form>
				<label for="CropType">Crop Type:</label>
				<select id="cropType">
					<option value="Tomato">Tomato</option>
					<option value="Potato">Potato</option>
					<option value="Corn">Corn</option>
				</select><br><br>
				<input type = "button" id = "new" value = "New"><br><br>
				<input type = "button" id = "save" value = "Save"><br><br>	
				<textarea id="data" cols="30" rows="5"></textarea><br><br>
				<input type = "button" id = "load" value = "Load">
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
include("css/footer.php"); 
?> 
</body>
</html>
