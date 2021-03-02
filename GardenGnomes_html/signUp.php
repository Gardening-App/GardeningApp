
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
	if (!session_id()) {
		session_start();
	}
	require("dbConnect.php");
	require("dbfunctions.php");
	require("callQuery.php");
	include("css/header.php"); 


?> 

	<div id="login">
		<p> Sign Up </p>
		

<?php 
$success = false;


	if (isset($_POST['signup'])) {

		// check for username
		$query = "SELECT * FROM user
					WHERE username = '" . $_POST['username'] . "'";
		$errorMessage = "Error signing up";
		$userNameRes = callQuery($pdo, $query, $errorMessage);

		if ($userNameRes->fetch()) {
			echo('Names taken, sorry.');
		} else {
			$sql = "INSERT INTO user (username, password) VALUES (?, ?)";

            $pdo->beginTransaction();
            $preppedSql = $pdo->prepare($sql);
            $preppedSql->execute([$_POST['username'], $_POST['password']]);
            $pdo->commit();

			$success = true;
			unset($_POST['signup']);
			echo('Thanks for signing up');
			$_SESSION['loggedIn'] = true;
			$_SESSION['userID'] = getLastUserID($pdo);
		}
	}


	// Display form if unsuccesful or haven't tried sign up

	if (!$success) {

?> 
		<form action="" method = "post">
		</form>


		<form action="" method = "post">
			<div id="user">
				<label  for="username">Username:</label>
				<input name ="username" id = "username">
			</div>
			<div id="pass">
				<label for ="password">Password:</label>
				<input type = 'password' name ="password" id = "password">
			</div>
			<div id="confirm">
				<label for ="password">Confirm Password:</label>
				<input type = 'password' name ="password" id = "passwordConfirm">
			</div>
			<input class="submit" type="submit" name="signup" id = "submit", value = "Sign Up">
		</form>


		<?php
	}
	?> 

			
		
		
	</div>
				</div>
		<?php
include("css/footer.php"); 
?> 
<script src = "Js/jquery-3.5.1.min.js"></script>
	<script src = 'Js/signup.js'></script>
</body>
</div>
</html>
