<?php

    include('connection.php');
    include('creation.php');

    if(isset($_POST['username']) && isset($_POST['q1']) && isset($_POST['q2']) && isset($_POST['q3'])){
        $username = $_POST['username'];
        $q1 = (int) $_POST['q1'];
        $q2 = (int) $_POST['q2'];
        $q3 = (int) $_POST['q3'];

        $sql = $conn->prepare("INSERT INTO Carts (username, q1, q2, q3) VALUES (?,?,?,?);");
        $sql->bind_param("siii", $username, $q1, $q2, $q3);
        $sql->execute();
        $sql->close();

        echo json_encode(["status" => "success"]);
    }

    else{
        echo json_encode(["status" => "error", "message" => "Missing required data"]);
    }

?>