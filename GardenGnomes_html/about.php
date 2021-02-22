
<html>
<head>

 
    <link rel="stylesheet" href="css/about.css">
    
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">


    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GQZJBXV4ZH"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.js"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
 
        gtag('config', 'G-GQZJBXV4ZH');
    </script>

  <title>About page</title>
</head>



<body>

    <?php
        include("css/header.php"); 
     ?> 

<div id="pages">
    <img id="shop" src="images/shop.jpeg">
    <img id="plan" src="images/grid.jpeg">
    <img id="blog" src="images/blog.jpeg">
</div>

<div id="pagesNames">
    <ul>
        <li>Shop our store</li>
        <li>Plan your garden</li>
        <li>view our blog</li>
    </ul>

</div>



    <img id="gnome" src="images/gnome.webp">
<p id="welcome">
    Do you ever get frustrated planning the layout of your garden and you can't remember what you have planted and where?
    Thats why we created Garden Gnomes. A community for gardening enthusiasts to plan and track their gardens. If you are
    new to gardening this is also a great place to learn and be social to see what other users are doing. 
</p>

<p id="welcome2">
    Check out our fun and easy to use<a href="layout.html"> layout </a> feature to keep track of your garden. 
    This feature allows you to pick what fruit you are going to plant and place it so you can see how it will align with 
    your current set up. 
</p>
<br><br><br><br><br>

<script src="js/about.js"></script>
<div id='calendar'></div>
<br>


<?php

    include("css/footer.php"); 
?> 
</body>

</html>
