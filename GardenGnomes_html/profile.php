<?php
if (!session_id()) {
	session_start();
}
require("dbConnect.php");
require("callQuery.php");
require("dbfunctions.php");
require("profilePicture.php");


?>

<html>

<head>




	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/profile.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">




	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	<script src="Js/profilePicture.js"></script>


	<title>About page</title>
</head>




<body>
		
			<?php
			include("css/header.php");
			?>

			<div class="content-wrapper">
			<?php
			// Check to see if user is logged in
			if (isset($_SESSION['loggedIn'])) {


				try {
					$userID = $_SESSION['userID'];
					$query = "SELECT count(1) as num FROM profile where userID = '$userID'";
					$errorMessage = "Error retrieving info";
					$profileResult = callQuery($pdo, $query, $errorMessage);
					$row = $profileResult->fetch();
					$result = $row['num'];
					$age = 0;
					$phone = "";
					$email = "";
					$address = "";
					$fPlant = "";


					if (isset($_POST['age'])) {
						$age = intval($_POST['age']);
						$query = "UPDATE profile SET age = '$age' WHERE userID = '$userID'";
						$profileResult = callQuery($pdo, $query, $errorMessage);
					}
					if (isset($_POST['phone'])) {
						$phone = $_POST['phone'];
						$query = "UPDATE profile SET phone = '$phone' WHERE userID = '$userID'";
						$profileResult = callQuery($pdo, $query, $errorMessage);
					}
					if (isset($_POST['email'])) {
						$email = $_POST['email'];
						$query = "UPDATE profile SET email = '$email' WHERE userID = '$userID'";
						$profileResult = callQuery($pdo, $query, $errorMessage);
					}
					if (isset($_POST['address'])) {
						$address = $_POST['address'];
						$query = "UPDATE profile SET address = '$address' WHERE userID = '$userID'";
						$profileResult = callQuery($pdo, $query, $errorMessage);
					}
					if (isset($_POST['fPlant'])) {
						$fPlant = $_POST['fPlant'];
						$query = "UPDATE profile SET favoritePlant = '$fPlant' WHERE userID = '$userID'";
						$profileResult = callQuery($pdo, $query, $errorMessage);
					}


					if ($result == 1) {
						// Query through layouts associated with current user
						$query = "SELECT * FROM profile where userID = '$userID'";
						$profileResult = callQuery($pdo, $query, $errorMessage);
						$row = $profileResult->fetch();
						$age = $row['age'];
						$phone = $row['phone'];
						$email = $row['email'];
						$address = $row['address'];
						$fPlant = $row['favoritePlant'];

						if (isset($_POST['pass1']) && isset($_POST['pass2'])) {
							$passSuccess = false;
							$pass1 = $_POST['pass1'];
							$pass2 = $_POST['pass2'];
							if ($pass1 == $pass2) {
								$query = "UPDATE user SET password = '$pass1' WHERE userID = '$userID'";
								$profileResult = callQuery($pdo, $query, $errorMessage);
								$passSuccess = true;
							}
						}

						if (isset($_POST['user'])) {
							$user = $_POST['user'];
							$userSuccess = false;
							$query = "SELECT count(1) as num FROM user 
							WHERE username = '$user'";
							$userResult = callQuery($pdo, $query, $errorMessage);
							$row = $userResult->fetch();
							$existingUser = $row['num'];
							if ($existingUser < 1) {
								$query = "UPDATE user SET username = '$user' WHERE userID = '$userID'";
								$profileResult = callQuery($pdo, $query, $errorMessage);
								$userSuccess = true;
							}
						}

						if (isset($_POST['delete'])) {
							$deleteSuccess = false;
							if ($_POST['delete'] == "Delete") {
								$query = "SELECT * FROM layout WHERE userID = '$userID'";
								$layoutResults = callQuery($pdo, $query, $errorMessage);

								foreach($layoutResults as $layout) {
									$layoutId = $layout['layoutID'];
									$query = "DELETE FROM shape WHERE layoutID = $layoutId;";
									callQuery($pdo, $query, $errorMessage);
									
								}

								$query = "DELETE FROM layout WHERE userID = $userID;";
								callQuery($pdo, $query, $errorMessage);
								$query = "DELETE FROM harvest WHERE userID = $userID;";
								callQuery($pdo, $query, $errorMessage);
								$query = "DELETE FROM social WHERE user_userID = $userID;";
								callQuery($pdo, $query, $errorMessage);
								$query = "DELETE FROM profile WHERE userID = $userID;";
								callQuery($pdo, $query, $errorMessage);
								$query = "DELETE FROM user WHERE userID = '$userID';";
								$profileResult = callQuery($pdo, $query, $errorMessage);
								$deleteSuccess = true;

								unset($_SESSION['loggedIn']);
								$_SESSION['userID'] = 0;
?> 
				<script>window.location.replace("about.php");</script>
<?php
							}
						}
					} else {

						$query = "INSERT INTO profile (userID) VALUES ('$userID')";
						$profileResult = callQuery($pdo, $query, $errorMessage);
					}
				} catch (exception $e) {
					echo $age;
					echo "<option value = '' sqlID = ''>Error connecting</option>";
				}
			} else { //User is not logged in
				echo "<option value = '' sqlID = ''>Please log in</option>";
			}

			?>
				<div id="columnOne">
					<form id="uploadPicture" action="upload.php" method="post" enctype="multipart/form-data">
						Select image to upload:
						<input id="chooseFile" type="file" name="fileToUpload" id="fileToUpload">
						<input id="upload" type="submit" value="Upload Image" name="submit">
					</form>
					<input id="changePicture" type="submit" value="Change Picture">
					<div id="imageBorder">
						<div>
							<?php setProfilePicture($pdo) ?>
							<!-- <img src="images/gnome.webp"> -->
						</div>
					</div>
					<?php setName($pdo) ?>
					<!-- <p id="nameLabel">Name</p> -->

					<div id="friendsContainer">
						<h2>Friends</h2>
						<ul>
							<li><img src="images/shop.jpeg">
								<p>Jennifer</p>
							</li>
							<li><img src="images/gnome.webp">
								<p>Bryan Breynolds</p>
							</li>
							<li><img src="images/shop.jpeg">
								<p>Farmer Suzy</p>
							</li>
						</ul>
					</div>


					<div id="deleteAccount">
						<h2>Delete Account</h2>
						<?php if (isset($_POST['delete'])) {
						if ($deleteSuccess) {
							echo "<p> Account Successfully Deleted </p>";
						} else {
							echo "<p> type 'Delete' to remove account <p>";
						}
					} ?>
						<form action="" method="post">
							<div>
								<label for="age">Confirm:</label>
								<input type="text" id="deleteBox" name="delete" placeholder="Type Delete"><br><br>
							</div>

						
								<input type="submit" id="deleteSub" value="Delete">
							
						</form>
					</div>

				</div>



			<div id="columnTwo">

				<div id="personalContainer">
					<h2>Personal Info</h2>
					<div id="personalInfo">
						<form action="" method="post">
							<div>
								<label for="age">Age:</label>
								<input type="text" id="age" name="age" value=<?php echo " '$age' "; ?>><br><br>
							</div>
							<div>
								<label for="phone">Phone:</label>
								<input type="text" id="nPass" name="phone" value=<?php echo " '$phone' "; ?>><br><br>
							</div>
							<div>
								<label for="email">Email:</label>
								<input type='email' id="nPass" name="email" value=<?php echo " '$email' "; ?>><br><br>
							</div>
							<div>
								<label for="address">Address:</label>
								<input type="text" id="nPass" name="address" value=<?php echo " '$address' "; ?>><br><br>
							</div>
							<div>
								<label for="fPlant">Favorite Plant:</label>
								<input type="text" id="nPass" name="fPlant" value=<?php echo " '$fPlant' " ?>><br><br>
							</div>
							<div>
								<input type="submit" id="saveInfo" value="Save">
							</div>
						</form>
					</div>

				</div>



				<div id="accountContainer">
					<h2>Account Info</h2>
					<?php if (isset($_POST['pass1']) && isset($_POST['pass2'])) {
						if ($passSuccess) {
							echo "<p> Password Successfully Updated </p>";
						} else {
							echo "<p> Failed update <p>";
						}
					} ?>
					<?php if (isset($_POST['user'])) {
						if ($userSuccess) {
							echo "<p> Username Successfully Updated </p>";
						} else {
							echo "<p> Username already exists <p>";
						}
					} ?>
					<div id="changePassword">
						<form action="" method="post">
							<div>

								<label for="nPass">New Password:</label>
								<input type="text" id="nPass" name="pass1"><br><br>
							</div>
							<div>
								<label for="cPass">Confirm Password:</label>
								<input type="text" id="cPass" name="pass2"><br><br>
							</div>
							<input type="submit" value="Change Password">
						</form>
					</div>

					<div id="changeUsername">
						<form action="" method="post">
							<div>
								<label for="fname">New Username:</label>
								<input type="text" id="" name="user"><br><br>
							</div>
							<input type="submit" value="Change Username">
						</form>
					</div>
				</div>

			</div>

			</div>
		<?php

		include("css/footer.php");
		?>
		
</body>

</html>
