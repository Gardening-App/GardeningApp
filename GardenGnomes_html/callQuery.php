<?php
//
// Run passed-in query returning result set (PDOStatement object)
// on success or exit on failure
//
<<<<<<< HEAD
function callQuery($pdo, $query, $error) {

=======

function callQuery($pdo, $query, $error) {

  return $pdo->query($query);
>>>>>>> Cody
  try {
    return $pdo->query($query);
  } catch (PDOException $ex) {

    $error .= $ex->message();
    include 'error.html.php';
    throw $ex;
    //exit();

  }

}