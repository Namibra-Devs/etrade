<?php
require_once '../helpers/auxiliaries.php';

// Check if it is a POST request and if the signin button was clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Call the loginUser function
    $userManager = new UserManager();
    $result = $userManager->loginUser($email, $password);

    if (!$result['errors']) {
        // Login successful
        echo json_encode([
            'message' => $result['message'],
            'user_id' => $result['user_id']
        ]);

        echo "<script>alert('Login Successful!'); window.location.href='../index.php';</script>";

    } else {
        // Login failed
        echo json_encode([
            'message' => $result['message']
        ]);
        echo "<script>alert('Login Failed!');</script>";
    }
}


?>