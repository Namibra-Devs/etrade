<?php
require_once 'config.php';

try {
    $con = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Call the createUsersTable function if connection was successful
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
