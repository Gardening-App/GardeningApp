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


<div class="page-container">
	<div class="content-wrapper">

		<body>

			<?php
			include("css/header.php");
			?>

			<div id="contentWrapper">
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
					<p id="profileName" contenteditable="true">Mr. Gnome</p>

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
				</div>


				<div id="columnTwo">

					<div id="personalContainer">
						<h2>Personal Info</h2>
						<div id="personalInfo">
							<form action="">
								<div>
									<label for="nPass">Age:</label>
									<input type="text" id="nPass" name="nPass"><br><br>
								</div>
								<div>
									<label for="nPass">Contact:</label>
									<input type="text" id="nPass" name="nPass"><br><br>
								</div>
								<div>
									<label for="nPass">Email:</label>
									<input type="text" id="nPass" name="nPass"><br><br>
								</div>
								<div>
									<label for="nPass">Address:</label>
									<input type="text" id="nPass" name="nPass"><br><br>
								</div>
								<div>
									<label for="nPass">Favorite Plant:</label>
									<input type="text" id="nPass" name="nPass"><br><br>
								</div>
							</form>
						</div>

					</div>



					<div id="accountContainer">
						<h2>Account Info</h2>
						<div id="changePassword">
							<form action="">
								<div>
									<label for="nPass">New Password:</label>
									<input type="text" id="nPass" name="nPass"><br><br>
								</div>
								<div>
									<label for="cPass">Confirm Password:</label>
									<input type="text" id="cPass" name="cPass"><br><br>
								</div>
								<input type="submit" value="Change Password">
							</form>
						</div>

						<div id="changeUsername">
							<form action="">
								<div>
									<label for="fname">New Username:</label>
									<input type="text" id="" name="fname"><br><br>
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
	</div>
	</body>

</html>