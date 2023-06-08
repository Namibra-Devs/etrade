<?php
require_once '../helpers/auxiliaries.php';

// Check if is apost request and signin button was clicked
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])){
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Call the loginUser function
    // $result = loginUser($email, $password);

    // if (!$result['errors']) {
    //         // Login successful
    //         echo json_encode([
    //             'message' => $result['message'],
    //             'user_id' => $result['user_id']
    //         ]);
    // } else {
    //         // Login failed
    //         echo json_encode([
    //             'message' => $result['message']
    //         ]);
    // }

  
}
echo "Password:". $password." Email:".$email;

echo "<script>alert('Login Sucessful!');
window.location.href='../index.php';</script>";



?>