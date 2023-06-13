<?php
include_once '../db/conn.php';
include_once 'session.php';

class UserManager
{
    private $con;

    public function __construct()
    {
        global $con;
        $this->con = $con;
    }

    // Function to validate user details
    public function validateUserDetails($name, $email, $password, $confirmPassword)
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

        // Validate confirm password
        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match!";
        }

        return $errors;
    }

    // Function to insert a new user into the database
    public function createUser($name, $email, $password, $confirmPassword)
    {
        $result = array('errors' => false);

        $errors = $this->validateUserDetails($name, $email, $password, $confirmPassword);

        if (count($errors) > 0) {
            // Handle validation errors (e.g., display error messages to the user)
            $result['errors'] = true;
            $result['message'] = $errors;

            return $result;
        }

        // Check if user with the given email already exists
        $getUserQuery = "SELECT * FROM users_1 WHERE email = :email";
        $statement = $this->con->prepare($getUserQuery);
        $statement->execute([':email' => $email]);
        $existingUser = $statement->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            // User with the provided email already exists
            $result['errors'] = true;
            $result['message'] = 'User with this email already exists!';

            return $result;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $createUserQuery = "INSERT INTO users_1 (name, email, password) VALUES (:name, :email, :password)";
        $queryParams = [':name' => $name, ':email' => $email, ':password' => $hashedPassword];
        $statement = $this->con->prepare($createUserQuery);
        $statement->execute($queryParams);

        $result['message'] = 'User created successfully';
        $result['user_id'] = $this->con->lastInsertId();

        return $result;
    }

    // Function to check if a user with the given email and password exists in the database
    public function loginUser($email, $password)
    {
        $result = array('errors' => false);

        $getUserQuery = "SELECT * FROM users_1 WHERE email = :email";
        $statement = $this->con->prepare($getUserQuery);
        $statement->execute([':email' => $email]);
        $user = $statement->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Check if user is admin and update the session variable
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $result['errors'] = false;
            $result['user_id'] = $user['id'];
            $result['message'] = 'Login Successful!';
            $result['user_id'] = $user['id'];

            return $result;
        }

        $result['message'] = 'Login Failed, Invalid email or password!';
        return $result;
    }

    // Function to check if a user is logged in
    public function checkUserLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    // Function to retrieve user information by user ID
    public function getUserById($userId)
    {
        $getUserQuery = "SELECT * FROM users_1 WHERE id = :id";
        $statement = $this->con->prepare($getUserQuery);
        $statement->execute([':id' => $userId]);
        return $statement->fetch();
    }

    // Function to retrieve all users
    public function getAllUsers()
    {
        $result = array('errors' => false);

        $getAllUsersQuery = "SELECT * FROM users_1";
        $statement = $this->con->prepare($getAllUsersQuery);
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
    public function updatePassword($userId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updatePasswordQuery = "UPDATE users_1 SET password = :password WHERE id = :id";
        $statement = $this->con->prepare($updatePasswordQuery);
        $statement->execute([
            ':password' => $hashedPassword,
            ':id' => $userId
        ]);

        return $statement->rowCount();
    }

    // Function to update a user's information
    public function updateUser($userId, $name, $email)
    {
        $updateUserQuery = "UPDATE users_1 SET name = :name, email = :email WHERE id = :id";
        $statement = $this->con->prepare($updateUserQuery);
        $statement->execute([
            ':name' => $name,
            ':email' => $email,
            ':id' => $userId
        ]);

        return $statement->rowCount();
    }

    // Function to delete a user
    public function deleteUser($userId)
    {
        $deleteUserQuery = "DELETE FROM users_1 WHERE id = :id";
        $statement = $this->con->prepare($deleteUserQuery);
        $statement->execute([':id' => $userId]);

        return $statement->rowCount();
    }
}

?>
