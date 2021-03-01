<?php

    if(isset($_POST["id"])){
        $connect = new PDO('mysql:host=localhost:3306;dbname=gardengnomes', 'root', 'mysql');

        $query =  "
        DELETE from shacalendere WHERE id=:id
        ";

        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':id'   => $_POST['id']
            )
            );
    }
?>