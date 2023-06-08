<?php
require_once 'config.php';

// try {
//     $con = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     // Call the createUsersTable function if connection was successful
//     if ($con) createUsersTable($con);
// } catch (PDOException $e) {
//     die("Database connection failed: " . $e->getMessage());
// }

// function createUsersTable($con){
//     try {
//         // SQL query to create the users table
//         $sql = "CREATE TABLE IF NOT EXISTS users (
//             id INT(11) NOT NULL AUTO_INCREMENT,
//             name VARCHAR(100) NOT NULL,
//             email VARCHAR(100) NOT NULL,
//             password VARCHAR(255) NOT NULL,
//             is_admin TINYINT(1) NOT NULL DEFAULT 0,
//             created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//             PRIMARY KEY (id),
//             UNIQUE KEY email (email)
//         )";
        
    
//         // Execute the query
//         $con->exec($sql);
//         return true;
    
//     } catch (PDOException $e) {
//         echo "Error creating table: " . $e->getMessage();
//         return false;
//     }
// }
?>
