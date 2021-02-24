<?php
require 'dbConnect.php';
function setComments($pdo) {
  if (isset($_POST['commentSubmit'])) {

    $error = "Come on already";
    $userId = 1;

    $comment = $_POST['comment'];

    $sql = 'INSERT INTO social (user_userID, comment_date, comment) 
            VALUES (?, now(), ?)';

    $preppedSql = $pdo->prepare($sql);

    $preppedSql->execute([1, $comment]);
  }
}

function getComments($pdo) {
  $sql = "SELECT * FROM social";
  $result = $pdo->query($sql);
  while ($row = $result->fetch()) {
    echo "<div class='commentbox'><p>"
      . $row['user_userID']."<br>"
      . $row['comment_date']."<br><br>"
      . nl2br($row['comment'])
    . "</p></div>";
  }
  
}