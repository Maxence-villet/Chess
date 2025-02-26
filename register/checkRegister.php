<?php
session_start();
require 'database.php';

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    $errors = [];
    if (strlen($password) < 8) {
        $errors[] = "The password must be at least 8 characters long.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "The password must contain at least one digit.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "The password must contain at least one uppercase letter.";
    }
    if (!preg_match('/[\W_]/', $password)) {
        $errors[] = "The password must contain at least one special character.";
    }
    return $errors;
}

function pass_hash($pass){
    return hash('sha256', $pass);
}

if (isset($_POST['submit'])) {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($email) && !empty($username) && !empty($password) && !empty($confirm_password)) {

        if (!validateEmail($email)) {
            $_SESSION['error'] = "The email address is not valid.";
        } else {
            
            if (strlen($username) < 4) {
                $_SESSION['error'] = "The username must be at least 4 characters long.";
            } else {
                
                    $passwordErrors = validatePassword($password);
                    if (!empty($passwordErrors)) {
                     $_SESSION['error'] = nl2br(implode($passwordErrors));
                    } elseif ($password !== $confirm_password) {
                     $_SESSION['error'] = "The passwords do not match.";
                    } else {
                        $hashedPassword = pass_hash($password);
                        try {

                            $insert = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
                            $stmt = $conn->prepare($insert);
                            $stmt->execute([
                                ':email' => $email,
                                ':username' => $username,
                                ':password' => $hashedPassword
                            ]);
                            $_SESSION['success'] = "Registration successful! You can now log in."; 
                        } catch (PDOException $e) {
                            $_SESSION['error'] = "Error: An unexpected error occurred.";
                        }
                    }
                }
            }
        }
    }
header("Location: register.php");    
?>
