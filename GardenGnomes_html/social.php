<?php
  if (!session_id()) {
    session_start();
  }
  require 'comments.php';
  require 'sanitize.php';
  require 'callQuery.php';
  setComments($pdo); ?>
<html lang="en">
<head>
	<title>Garden Gnome</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/social.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">
</head>
	<?php include("css/header.php"); ?> 
<div class="page-container">
<div class="content-wrapper">
<body>
	<div id ="wrapper">
		<div id ="comment">

      <h3>Garden News Forum</h3><?php

      if (!isset($_SESSION['loggedIn'])) {
        getComments($pdo);
      } else {

      echo "<form id='commentform' method='POST' action=''>

        <label for='comment'>Show us your goods!</label>
        <input type='hidden' name='username' value='".$_SESSION['username']."'>
        <input type='hidden' name='userId' value='".$_SESSION['userID']."'>
        <textarea name='comment' id='comment' rows='10' tabindex='4'></textarea>        
        <button type='submit' id='commentSubmit' name='commentSubmit'>Comment</button>
        
        </form>";
        
        getComments($pdo); 

      } ?>

    </div> <!-- end div #comment -->		
  </div> <!-- end div #wrapper -->
</div> <!-- end div .content-wrapper -->
<script>
if ( window.history.replaceState ) {
  window.history.pushState( null, null, window.location.href );
}
</script>
<script src="Js/jquery-3.5.1.min.js"></script>
<script src="Js/removeDiv.js"></script>
  <?php include("css/footer.php"); ?>
</body>
</div> <!-- end div .page-container -->
</html>
