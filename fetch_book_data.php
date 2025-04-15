<?php
    include('connection.php');
    include('creation.php');

    $q_books = "SELECT Book_Name, Book_Price FROM Products;";
    $result = $conn->query($q_books);
    
    
    $books = [];
    while($row=$result->fetch_assoc()){
        $books[] = $row;
    }

    header("Content-Type: application/json");
    echo json_encode($books);
?>