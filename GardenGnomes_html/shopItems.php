<?php
require 'dbConnect.php';

function setShopItems($pdo) {
  $sql = "SELECT * FROM shop";
  $result = $pdo->query($sql);
  while ($row = $result->fetch()) {
    $item = $row['item'];
    $image = $row['picture'];
    $link = $row['link'];
    $price = $row['price'];
    echo "<figure class='imageWrapper'>
      <image src='".$image."'>
      <figcaption>".$item."</figcaption>
      <figcaption><a class = 'buy' href='".$link."' target ='_blank' rel=''noopener noreferrer'>Buy<a/> - ".$price."</figcaption>
    </figure>";
  }

}


