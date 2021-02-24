<?php

if (!session_id()) {
	session_start();
}

include("css/footer.php");
include("css/header.php"); 
?> 
<html>
<head>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">
  <title>About page</title>
</head>

<body>
	<?php
	$wrongMessage = '';
	$triedLogin = false;

	// Log out
	if (isset($_POST['logOut'])) {
		$_SESSION['loggedIn'] = FALSE;
	}


	if ($_SESSION['loggedIn'] || (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']))) {
		

		if ($_SESSION['loggedIn'] || ($_POST['username'] == 'user' && $_POST['password'] == '123')) {
			$_SESSION['loggedIn'] = true;
		} else {
			$wrongMessage = 'Try user: user, password: 123';
		}

		$triedLogin = true;
	} 	?> 
	<div id="login">
		<p> Login </p>
		<?php
		if ($_SESSION['loggedIn']) {
	?> 
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">

			<input class="submit" type="submit" name="logOut" value = "Log out">
		</form>
	<?php
		} else {
			if ($triedLogin == true) {
				echo ('<p>' . $wrongMessage . '</p>');
			}

		?> 

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
			<div id="user">
				<label  for="username">Username:</label>
				<input name ="username">
			</div>
			<div id="pass">
				<label for ="password">Password:</label>
				<input type = 'password' name ="password">
			</div>
			<input class="submit" type="submit" name="login", value = "Login">
		</form>

			
		<?php }?>
		
	</div>
	
	
</body>

</html>
