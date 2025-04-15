<?php
    include('connection.php');

    $q_cdb = "CREATE DATABASE IF NOT EXISTS Bookify";
    $q_use_db = "USE Bookify";
    $q_ct_products = "CREATE TABLE IF NOT EXISTS Products(
                        SNo INT UNIQUE,
                        Book_Name VARCHAR(255) UNIQUE,
                        Book_Price VARCHAR(255));";
    $q_ct_customers = "CREATE TABLE IF NOT EXISTS Customers(
                        SNo INT AUTO_INCREMENT PRIMARY KEY,
                        Username VARCHAR(255),
                        Password VARCHAR(255));";
    $q_ct_carts = "CREATE TABLE IF NOT EXISTS Carts(
                        SNo INT AUTO_INCREMENT PRIMARY KEY,
                        Username VARCHAR(255),
                        q1 INT,
                        q2 INT,
                        q3 INT);";
    $q_i_products = "INSERT IGNORE INTO Products (SNo, Book_Name, Book_Price)
                        VALUES
                        (1, 'Killer Dutch', 100),
                        (2, 'My Great Predecessors', 200),
                        (3, 'Silman\'s Endgame Course', 300);";
    
    if($conn->query($q_cdb)===False){
        echo "Database(Bookify) Creation Status : 0.<br>";
    }

    $conn->query($q_use_db);

    if($conn->query($q_ct_products)===False){
        echo "Table (Products) Creation Status : 0.<br>";
    }

    if($conn->query($q_ct_customers)===False){
        echo "Table (Customers) Creation Status : 0.<br>";
    }

    if($conn->query($q_ct_carts)===False){
        echo "Table (Carts) Creation Status : 0.<br>";
    }

    if($conn->query($q_i_products)===False){
        echo "Table (Products) Insertion Status : 0.<br>";
    }
?>