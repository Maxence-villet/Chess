<?php
session_start();
require 'database.php';

if (isset($_POST['submitForm'])) {
 
    $db = Database::getInstance();
    $conn = $db->getConnection();

    function pass_hash($pass){
        return hash('sha256', $pass);
    }

    $email = $_POST['email'];
    $hashed_password = pass_hash($_POST['password']);

    try {
        $query = "SELECT id, username FROM users WHERE email = :email AND password = :pass";
        $stmt = $conn->prepare($query);
        $stmt->execute(['email' => $email, 'pass' => $hashed_password]);

        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['messagelogin'] = "Login successful!";
            $_SESSION['user_username'] = $user['usernamename'];
            $_SESSION['user_id'] = $user['id'];

            header("Location: updateProfile.php");
            exit;

        } else {
            $_SESSION['error'] = "Incorrect email or password.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error connecting to the database: ' . $e->getMessage();
    }
}

header("Location: login.php");
?>
