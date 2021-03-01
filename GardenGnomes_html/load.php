<?php

$connect = new PDO('mysql:host=localhost:3306;dbname=gardengnomes', 'root', 'mysql');
$data = array();

$query = "SELECT * FROM shacalendere ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);


?>