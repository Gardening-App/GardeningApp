<?php
  date_default_timezone_set('America/Chicago');
  require 'comments.php';
  require 'sanitize.php';
  require 'callQuery.php';
  setComments($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Garden Gnome</title>
  <meta charset="utf-8">
	<?php

include("css/footer.php");
include("css/header.php"); 
?> 

  <link rel="stylesheet" href="css/social.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
	<?php

 
include("css/header.php"); 
?> 
	 <div class="page-container">
<div class="content-wrapper">
<body>
	<div id ="wrapper">


		<div id ="comment">

      <h3>Garden News Forum</h3>
      <?php
      

      $error = "You stupid ahole";

      echo "<form id='commentform' method='POST' action=''>
        
        <label for='comment'>Show us your goods!</label>
        <input type='hidden' name='user_userID' value='Anonymous'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='comment' id='comment' rows='10' tabindex='4'></textarea>
        
        <button type='submit' name='commentSubmit'>Comment</button>

      </form>";

      getComments($pdo);

      
      ?>
    </div>
		
  </div>
</div>
  <?php
  include("css/footer.php");

  ?>
</body>
</div>
</html>
