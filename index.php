<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Include files for database and User class
include_once '../config/database.php';  // Path to database.php
include_once '../models/User.php';      // Path to User.php


// Create a new database connection
$database = new Database();
$db = $database->getConnection();

// Initialize User class
$user = new User($db);

// Check if it's a GET request (for displaying users)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $user->read();
    $num = $stmt->rowCount();

    if($num > 0) {
        $users_arr = array();
        $users_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $user_item = array(
                "userID" => $userID,
                "name" => $name,
                "email" => $email
            );
            array_push($users_arr["records"], $user_item);
        }

        // Return users in JSON format
        echo json_encode($users_arr);
    } else {
        echo json_encode(array("message" => "No users found."));
    }
} else {
    // If not a GET request, return HTML content (like your sign-up form)
    echo '<html><body>';
    echo '<h1>Sign-Up Page</h1>';
    echo '<form id="signup-form">';
    echo '<input type="text" id="name" name="name" placeholder="Name" required />';
    echo '<input type="email" id="email" name="email" placeholder="Email" required />';
    echo '<input type="password" id="password" name="password" placeholder="Password" required />';
    echo '<button type="submit">Sign Up</button>';
    echo '</form>';
    echo '<script src="script.js"></script>';
    echo '</body></html>';
}
?>
