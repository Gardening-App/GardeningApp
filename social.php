<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Social Page</title>

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/social.css">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet"> 
</head>

<div class="navWrapper">
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
      <li><a href="social.html">Social</a></li>
    </ul>
  </div>
  
  <p id="name">The Gardening Gnome <img src="images/gnome.webp" width="3%"></p>
  
  <p id="slogan">A community for gardeners.</p>
</div>

<div id="pages">
  <h1>Garden News Forum</h1>
</div>
<body>
  
<div id ="comment">
  
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

</body>

<footer>
	<img src="images/gnome.webp">
	<nav>
		<a href="about.html">About</a>
		<a href="layout.html">Layout</a>
		<a href="shop.html">Shop</a>
		<a href="social.html">Social</a>
	</nav>
</footer>

</html>