
<html>
<head>
    <link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/signUp.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">
  <title>About page</title>
</head>

<div class="page-container">
<div class="content-wrapper">	
<body>
	<?php
include("css/header.php"); 
?> 

	<div id="login">
		<p> Sign Up </p>
		
		<form action="" method = "post">
		</form>


		<form action="" method = "post">
			<div id="user">
				<label  for="username">Username:</label>
				<input name ="username">
			</div>
			<div id="pass">
				<label for ="password">Password:</label>
				<input type = 'password' name ="password">
			</div>
			<div id="confirm">
				<label for ="password">Confirm Password:</label>
				<input type = 'password' name ="password">
			</div>
			<input class="submit" type="submit" name="login", value = "Sign Up">
		</form>

			
		
		
	</div>
				</div>
		<?php
include("css/footer.php"); 
?> 
</body>
</div>
</html>
