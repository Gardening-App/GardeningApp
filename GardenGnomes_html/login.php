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

	$wrongMessage = 'Username or password error';
	$triedLogin = false;


		

	// Check to see if user is trying to log in
	if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
		

		// Check to see if username exists
		$query = "SELECT * FROM user
				WHERE username = '" . $_POST['username'] . "'";
		$errorMessage = "Error querying user names";
		$queryRes = callQuery($pdo, $query, $errorMessage);

		if ($userRes = $queryRes->fetch()) {

			//Check to see if password matches and set session vars if so
			if($_POST['password'] == $userRes['password']) {
				$_SESSION['loggedIn'] = true;
				$_SESSION['userID'] = $userRes['userID'];
				$_SESSION['username'] = $userRes['username'];
			} 
		}

		$triedLogin = true;
	}

?> 
<html>
<head>
    <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/login.css">
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
		<p> Login </p>

	<?php
		// Display log out form if logged in
		if (isset($_SESSION['loggedIn'])) {
	?> 
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">

			<input class="submit" type="submit" name="logOut" value = "Log out">
		</form>
	<?php
		// Display login form if not logged in
		} else {
			// Show wrong log in message on failed log in
			if (isset($triedLogin) and $triedLogin) {
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
				</div>
		<?php
include("css/footer.php"); 
?> 
</body>
</div>
</html>
