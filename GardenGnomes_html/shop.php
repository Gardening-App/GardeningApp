<?php

if (!session_id()) {
		session_start();
	}

date_default_timezone_set('America/Chicago');
require 'shopItems.php';
require 'sanitize.php';
require 'callQuery.php';
?>

<html>

<head>

    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/shop.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">
    <title>Shop Page</title>
</head>
<?php
include("css/header.php");
?>
<h1>Shop</h1>

<body>

    <!-- Displays each shop item listed on the database -->
    <div class="column">
        <?php setShopItems($pdo) ?>
    </div>

    <?php
    include("css/footer.php");
    ?>

</body>

</html>
