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
        <li><a href="about.php">About</a></li>
        <li><a href="layout.php">Layout</a></li>
        <li><a href="shop.php">Shop</a></li>
         <li><a href="social.php">Social</a></li>
         <li><a href="login.php">Login</a></li>
      </ul>
</div>

<p id="name">The Gardening Gnome <img src="images/gnome.webp" width="3%"></p>
<p id="slogan">A community for gardeners.</p>
	</div>
<style type="text/css">
.navWrapper{
    width: 100%;
    padding: 0%;
    margin: 0%;
    
    background-color: rgb(142, 199, 85);
  }
  
  body {
      background-color: #f1f1f1;
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
      font-size: 17pxx;
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