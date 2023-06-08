<?php
include '../db/conn.php';
include "./session.php";

// Function to validate user details
function validateUserDetails($name, $email, $password)
{
    $errors = [];

    // Validate name
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format!";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required!";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long!";
    }

    return $errors;
}

// Function to insert a new user into the database
function createUser($name, $email, $password, $is_admin)
{
    global $con;

    $result = array('errors' => false);

    $errors = validateUserDetails($name, $email, $password);

    if (count($errors) > 0) {
        // Handle validation errors (e.g., display error messages to the user)
        $result['errors'] = true;
        $result['message'] = $errors;

        return $result;
    }

    // Check if user with the given email already exists
    $getUserQuery = "SELECT * FROM users WHERE email = :email";
    $statement = $con->prepare($getUserQuery);
    $statement->execute([':email' => $email]);
    $existingUser = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        // User with the provided email already exists
        $result['errors'] = true;
        $result['message'] = 'User with this email already exists!';

        return $result;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($is_admin == 'true') {
        $is_admin = true;

        $createUserQuery = "INSERT INTO users (name, email, password, is_admin) VALUES (:name, :email, :password, :is_admin)";
        $statement = $con->prepare($createUserQuery);
        $statement->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':is_admin' => $is_admin

        ]);


        $result['message'] = 'Admin created successfully';
        $result['user_id'] = $con->lastInsertId();
    } else {

        $createUserQuery = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $statement = $con->prepare($createUserQuery);
        $statement->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);

        $result['message'] = 'User created successfully';
        $result['user_id'] = $con->lastInsertId();
    }


    return $result;
}


// Function to check if a user with the given email and password exists in the database
function loginUser($email, $password)
{
    global $con;
    $result = array('errors' => false);

    $getUserQuery = "SELECT * FROM users WHERE email = :email";
    $statement = $con->prepare($getUserQuery);
    $statement->execute([':email' => $email]);
    $user = $statement->fetch();

    if ($user && password_verify($password, $user['password'])) {
        //Check if user is admin and update the session variable
        if ($user['is_admin']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            // return $user['id'];
        }
        $result['errors'] = false;
        $result['user_id'] =  $user['id'];
        $result['message'] = 'Login Successful!';
        $result['user_id'] =  $user['id'];

        echo implode(', ', $_SESSION);
        var_dump($_SESSION);
        return $result;
    }
    $result['message'] = 'Login Failed, Invalid email or password!';
    return $result;
}




// Function to check if a user is admin
function isAdmin()
{
    return isset($_SESSION['is_admin']);
}

// Function to check if a user is logged in
function checkUserLoggedIn()
{
    return isset($_SESSION['user_id']);
}

// Function to retrieve user information by user ID
function getUserById($userId)
{
    global $con;

    $getUserQuery = "SELECT * FROM users WHERE id = :id";
    $statement = $con->prepare($getUserQuery);
    $statement->execute([':id' => $userId]);
    return $statement->fetch();
}

// Function to retrieve all users
function getAllUsers()
{
    global $con;
    $result = array('errors' => false);

    $getAllUsersQuery = "SELECT * FROM users";
    $statement = $con->prepare($getAllUsersQuery);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($users) {
        $result['message'] = $users;
        return $result;
    }

    $result['message'] = 'No User Found!';
    $result['errors'] = true;
    return $result;
}

// Function to update a user's password
function updatePassword($userId, $newPassword)
{
    global $con;

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $updatePasswordQuery = "UPDATE users SET password = :password WHERE id = :id";
    $statement = $con->prepare($updatePasswordQuery);
    $statement->execute([
        ':password' => $hashedPassword,
        ':id' => $userId
    ]);

    return $statement->rowCount();
}

// Function to update a user's information
function updateUser($userId, $name, $email)
{
    global $con;

    $updateUserQuery = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $statement = $con->prepare($updateUserQuery);
    $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':id' => $userId
    ]);

    return $statement->rowCount();
}

// Function to delete a user
function deleteUser($userId)
{
    global $con;

    $deleteUserQuery = "DELETE FROM users WHERE id = :id";
    $statement = $con->prepare($deleteUserQuery);
    $statement->execute([':id' => $userId]);

    return $statement->rowCount();
}
