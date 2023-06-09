<?php 
require_once "../helpers/auxiliaries.php";

// Check if is apost request and create account button was clicked
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])){

        // Retrieve form data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirmpassword'];
 
        // Call the createUser function
        $userManager = new UserManager();
        $result = $userManager->createUser($username, $email, $password, $confirm_password);

        if (!$result['errors']) {
            // Registration successful
            echo json_encode([
                'message' => $result['message'],
                'user_id' => $result['user_id']
            ]);

            echo "<script>alert('Registration Sucessful!');
            window.location.href='../index.php';</script>";
        } else {
            // Registration failed
            echo json_encode([
                'message' => $result['message']
            ]);

            echo "<script>alert('Registration Failed!');</script>";
        }
        
    } 




?>