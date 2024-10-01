<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email or Password is empty";
        header("Location: login.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid Email format";
        header("Location: login.php");
        exit();
    }

    $query = "SELECT * FROM users WHERE email = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $email;
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error'] = "Invalid Password";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid Email";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Database query failed";
        header("Location: login.php");
        exit();
    }
}
?>
