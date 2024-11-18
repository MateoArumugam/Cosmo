<?php
include 'db_connect.php';

// Create Admin
function createAdmin($name, $role) {
    global $conn;
    $sql = "INSERT INTO Admins (name, role) VALUES ('$name', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "New admin created successfully";
    } else {
        echo "Error: " . $sql . "<br