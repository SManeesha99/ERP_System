<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "erpsystem";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);

    $sql = "DELETE FROM customer WHERE id=$id";
    $result = $connection->query($sql);
}

header("Location: /ERP_System/index.php");
exit();

?>