<?php
require 'dbConnect.php';

if (!session_id()) {
  session_start();
}


function setProfilePicture($pdo) {
  $userId = $_SESSION['userID'];
  
  $sql = "SELECT * FROM user WHERE userID = '" . $userId . "' ";
  $result = $pdo->query($sql);
  while ($row = $result->fetch()) {
    $profilePicture = $row['profilepicture'];
  }

  echo "<image src='".$profilePicture."'>";

}

function setName($pdo) {

  $userId = $_SESSION['userID'];
  
  $sql = "SELECT * FROM user WHERE userID = '" . $userId . "' ";
  $result = $pdo->query($sql);
  while ($row = $result->fetch()) {
    $name = $row['username'];
  }

  echo "<p id='nameLabel'>".$name."</p>";


}
