<?php
    include('connection.php');
    include('creation.php');

    $r_username = "";
    $r_password = "";

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $r_username = $_POST['r_username'];
        $r_password = $_POST['r_password'];
    }

    $q_customer = "SELECT * FROM Customers WHERE Username = '$r_username' AND Password = '$r_password';";
    $result = $conn->query($q_customer);

    if($result->num_rows==0){
        $q_i_customer = "INSERT INTO Customers (Username, Password) VALUES ('$r_username', '$r_password')";
        if($conn->query($q_i_customer)===TRUE){
            echo "<script type='text/javascript'>
                    alert('Registration Successfull!');
                    window.location.href='signIn.html';
                  </script>";
        }
    }
    else{
        echo "<script type='text/javascript'>
                alert('Username Already Exists!');
                window.location.href='signIn.html';
              </script>";
    }
?>