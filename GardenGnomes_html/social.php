<!DOCTYPE html>
<html lang="en">
<head>
	<title>Garden Gnome</title>
  <meta charset="utf-8">
	<?php

include("css/footer.php");
include("css/header.php"); 
?> 

  <link rel="stylesheet" href="css/about.css">
  <link rel="stylesheet" href="css/social.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<div id ="wrapper">


		<div id ="comment">

      <h3>Garden News Forum</h3>
      <?php
      echo "<form id='commentform'>
             
        <label for='commenter_name'>Name</label>
        <input type='text' name='namebox' id='namebox' value='' tabindex='1'>
        
        <label for='comment'>Show us your goods!</label>
        <textarea name='comment' id='comment' rows='10' tabindex='4'></textarea>
        
        <button type='submit' name='submit'>Submit</button>

      </form>"
      ?>
    </div>
		
  </div>
	
</body>
</html>
