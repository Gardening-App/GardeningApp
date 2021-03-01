<<<<<<< Updated upstream
<?php
//
// Run passed-in query returning result set (PDOStatement object)
// on success or exit on failure
//

function callQuery($pdo, $query, $error) {

  return $pdo->query($query);
  try {
    return $pdo->query($query);
  } catch (PDOException $ex) {

    $error .= $ex->message();
    include 'error.html.php';
    throw $ex;
    //exit();

  }

}
=======
<?php
//
// Run passed-in query returning result set (PDOStatement object)
// on success or exit on failure
//
function callQuery($pdo, $query, $error) {

  try {
    return $pdo->query($query);
  } catch (PDOException $ex) {

    $error .= $ex;
    include 'error.html.php';
    throw $ex;
    //exit();

  }

}
>>>>>>> Stashed changes
