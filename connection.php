<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "Bookify";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        echo "DB Connection Status : 0.<br>";
    }

?>