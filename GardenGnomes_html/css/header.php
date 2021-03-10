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
    <div class="dropdown">
  <button class="dropbtn">Account</button>
  <div class="dropdown-content">
    <?php
    if (isset($_SESSION['loggedIn'])) {
      echo "<a href='login.php'>Logout</a><a href='profile.php'>Profile</a>";
    } else {
    echo "<a href='login.php'>Login</a><a href='signup.php'>Sign up</a>";
    }
    ?>
  </div>
  </div>
        <li><a href="about.php">About</a></li>
        <li><a href="layout.php">Layout</a></li>
        <li><a href="shop.php">Shop</a></li>
         <li><a href="social.php">Social</a></li>
	 <li><a href="harvest.php">Harvest</a></li>
        <li>
        </ul>
   
        
</div>



<p id="name">The Gardening Gnome <img src="images/gnome.webp" width="3%"></p>
<p id="slogan">A community for gardeners.</p>
 
	</div>


  
<style type="text/css">
/* Dropdown Button */
.dropbtn {
  background-color: Transparent;
  color: #f1f1f1;
   
  font-size: 17px;
  border: none;
  
  
  
  
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
  float: left;
  padding-top: 3px;
  padding-right: 3px;
   
 
  
   
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: transparent;

  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #3e8e41;}
.navWrapper{
    width: 100%;
    padding: 0%;
    margin: 0%;
    
    background-color: rgb(142, 199, 85);
  }
  
  body {
      background-color: #FCFCFC;
      padding: 0;
      margin: 0;
      font-family: Arial;
       
    }
  
    /*
  Make nav bar links in one line
  */
    ul li {
      display: inline-block;
    }
    
   .navBar ul li:not(:last-child):after {
        padding-top: 2px;
      content: " ";
      color: #ddd;
      }
  
  
  #name {
    padding-left: 0;
    color: #ddd;
    padding-top: 5px;
    text-align: center;
    font-family: 'Yellowtail', cursive;
      font-size: 35px; 
       
  }
  /*
taking away defaut margins so The title can be positioned correctly
*/
p {
    margin: 0;
  }
  
  #slogan {
     
    margin-top: 4px;
    padding: 0;
    color: #ddd;
    font-family: 'Indie Flower', cursive;;
    text-align: center;
    font-weight: bold;
  }
  
  
  .social-Links li {
    padding-top: 12px;
    font-size: 23px;
    padding-right: 4px;
    color: #ddd;
  }
  
  
    .navBar{
       
      position: absolute;
      right:3px;
      top:2px;
      
    }
  
    .navBar a {
      position: relative;
      float: right;
      color: #ddd;
      text-align: center;
      padding: 5px 7px;
      text-decoration: none;
      font-size: 17px;
      cursor: pointer;
    
  }
  
  /*
  changes color of link when hover/ up to changes if any ideas
  */
  .navBar a:hover {
      background-color: #ddd;
      color: black;
  }
  </style>
