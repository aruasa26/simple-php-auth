<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CAT1";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error .  "\n");
    }

    // Create database if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully or already exists";
    } else {
        echo "Error creating database: " . $conn->error . "\n";
    }

    // Select the database
    $conn->select_db($dbname);

    // Create users table if not exists
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table users created successfully or already exists\n";
    } else {
        echo "Error creating table: " . $conn->error . "\n";
    }

?>
