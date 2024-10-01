<?php
session_start();
include 'config.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $errors = [];

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // If there are no errors, proceed to check for duplicate email
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Email is already registered.";
        } else {
            // If no duplicate email, proceed to store the user in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Registration successful!";
                header("Location: login.php");
                exit();
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }

    // Flash errors to the register page
    $_SESSION['errors'] = $errors;
    header("Location: register.php");
    exit();
}
?>