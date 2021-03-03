<?php
require 'dbConnect.php';
date_default_timezone_set('America/Chicago');
function setComments($pdo) {
  if (isset($_POST['commentSubmit']) && !empty($_POST['comment']) && !ctype_space($_POST['comment'])) {

    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $comment = trim($_POST['comment']);

    $sql = 'INSERT INTO social (username, user_userID, comment_date, comment) 
            VALUES (?, ?, now(), ?)';

    $preppedSql = $pdo->prepare($sql);

    $preppedSql->execute([$username, $userId, $comment]);
  }
}

function getComments($pdo) {

  $sql = "SELECT username, comment_date, comment, socialID, user_userID,
                 DATE_FORMAT(CONVERT(comment_date, date), '%m/%d/%y') AS date, 
                 DATE_FORMAT(CONVERT(comment_date, time), '%h:%i %p') AS time 
                 FROM social ORDER BY comment_date DESC;";
          
  $result = $pdo->query($sql);

  while ($row = $result->fetch()) {

    $currentDate = ltrim(date('m/d/y'), "0");
    $currentTime = ltrim(date('h:m A'), "0");
    $commentDate = ltrim($row['date'], "0");
    $commentTime = ltrim($row['time'], "0");
    $recentComment = strtotime($currentTime);
    $commentString = nl2br($row['comment']);
    $commentUserId = $row['user_userID'];
    $commentBoxId = $row['socialID'];
 
    /* Get comment date and time,
       create a new DateTime object,
       and format into a Unix timestamp */
    $commentDateTime = $row['comment_date'];
    $commentDateTime = new DateTime($commentDateTime);
    $commentDateTime = $commentDateTime->format('U');

    /* Create a new DateTime object for the current time
       and convert into a Unix timestamp */
    $currentDateTime = new DateTime();
    $currentDateTime = $currentDateTime->format('U');

    $yesterday = ltrim(date("m/d/y", strtotime("-1 day", $currentDateTime)), "0");

    echo "<div class='commentbox' id='$commentBoxId'><p><b>".$row['username']."</b><br>";

    if (($currentDateTime - $commentDateTime) <= 300) {
      echo "just commented...";
    } else if (($currentDateTime - $commentDateTime) >= 300 && $currentDate == $commentDate) {
      echo "Today at $commentTime";
    } else if ($commentDate == $yesterday) {
      echo "Yesterday at $commentTime";
    } else {
      echo "$commentDate at $commentTime";
    }

    if (isset($_SESSION['loggedIn'])) {
      if ($_SESSION['userID'] == $commentUserId) {     

        echo "<form id='delete".$row['socialID']."' method='POST' action=''>
        <input type='hidden' name='commentId' value='".$row['socialID']."'>
        <button type='delete' class='commentDelete id='delete' name='commentDelete'>Delete</button>
        </form>";

        if (isset($_POST['commentDelete'])) {

          $commentId = $_POST['commentId'];
          
          $sqlDelete = "DELETE FROM social 
                        WHERE socialID = (?)";

          $preppedSql = $pdo->prepare($sqlDelete);

          $preppedSql->execute([$commentId]);

          echo '<script type="Js/removeDiv.js">',
          "removeDiv($commentBoxId);",
          '</script>';
        }     
      }
    }  
    echo "$commentString</p></div>";
  }
}