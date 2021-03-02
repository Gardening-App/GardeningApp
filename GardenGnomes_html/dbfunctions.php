<?php 


    function getLastID($pdo) {
        $sql = "SELECT max(layoutID) AS ID FROM layout";
        $errorMessage = "Error fetching ID";
        $response = callQuery($pdo, $sql, $errorMessage);
        while ($row = $response->fetch()) {
            $layoutID = $row['ID'];
        }

        return $layoutID;
    }
    function deleteFromShapes($pdo, $layoutID) {
        echo ($layoutID);
        $sql = "DELETE FROM shape
        WHERE layoutID = $layoutID";
        //echo("<script>alert($layoutID)</script>");
        $errorMessage = "Error removing shapes";
        callQuery($pdo, $sql, $errorMessage);
    }

    function getLastUserID($pdo) {
        $sql = "SELECT max(userID) AS ID FROM user";
        $errorMessage = "Error fetching ID";
        $response = callQuery($pdo, $sql, $errorMessage);
        while ($row = $response->fetch()) {
            $userID = $row['ID'];
        }

        return $userID;
    }
?> 