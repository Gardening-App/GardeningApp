<!DOCTYPE html>
<html lang="en">
<head>
	<title>Garden Gnome</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/about.css">
  <link rel="stylesheet" href="css/social.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<div id ="wrapper">
    <div class="social-links">
      <ul class="d-flex">
        <li><a><i class="fa fa-facebook"></i></a></li>
        <li><a><i class="fa fa-youtube"></i></a></li>
        <li><a><i class="fa fa-instagram"></i></a></li>
      </ul>
    </div>
    <div class="navBar">
    
      <ul>
        <li><a href="about.html">About</a></li>
        <li><a href="layout.html">Layout</a></li>
        <li><a href="shop.html">Shop</a></li>
        <li><a href="social.php">Social</a></li>
        <li>
      </ul>
</div>

<p id="name">The Gardening Gnome <img src="images/gnome.webp" width="3%"></p>

<div id="pagesNames">
    <ul>
        <li>Shop our store</li>
        <li>Plan your garden</li>
        <li>view our blog</li>
    </ul>

</div>
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