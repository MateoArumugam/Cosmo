<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['userID'] = $user['userID'];
        $_SESSION['name'] = $user['name'];
        echo "Login successful! Welcome " . $user['name'];
        // Redirect or display user-specific content
    } else {
        echo "Invalid email or password.";
    }
}
?>
