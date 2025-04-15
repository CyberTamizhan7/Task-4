<?php
    include('connection.php');
    include('creation.php');

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        echo "hi";
        $l_username = $_POST['l_username'];
        $l_password = $_POST['l_password'];
        $q_customers = "SELECT * FROM Customers WHERE Username = '$l_username' AND Password = '$l_password'";
        $result = $conn->query($q_customers);
        if($result->num_rows>0){
            echo "<script type='text/javascript'>
                    alert('Login Successfull!');
                    localStorage.setItem('username', '$l_username');
                    window.location.href='mainPage.html';
                  </script>";
        }
        else{
            echo "<script type='text/javascript'>
                    alert('Invalid Credentials');
                    window.location.href='signIn.html';
                  </script>";
        }
    }
?>