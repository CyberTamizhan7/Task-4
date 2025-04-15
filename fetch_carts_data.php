<?php
    include('connection.php');
    include('creation.php');

    if(isset($_GET['username'])){
        $username = $_GET['username'];
        $sql = "SELECT q1, q2, q3 FROM Carts WHERE Username = '$username' ORDER BY SNo DESC LIMIT 1";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            echo json_encode([$row['q1'], $row['q2'], $row['q3']]);
        }
        else{
            echo json_encode([0, 0, 0]);
        }
    }

    else{
        echo json_encode(["error", "Username not received in fetch_carts_data.php"]);
    }

?>