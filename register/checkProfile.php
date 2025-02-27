<?php
session_start();
require_once 'Database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

if (isset($_POST['update_name'])) {

    $current_username = ($_POST['current_username']);
    $new_username = ($_POST['new_username']);
    $confirm_new_username = ($_POST['confirm_new_username']);

    if ($new_username !== $confirm_new_username) {
        $_SESSION['error'] = "The new usernames do not match.";
    } else {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT username FROM users WHERE id = :user_id");
        $stmt->execute(['user_id' => $_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['username'] !== $current_username) {
            $_SESSION['error'] = "The old username does not match.";
        } else {
  
            $stmt = $conn->prepare("SELECT username FROM users WHERE username = :new_username");
            $stmt->execute(['new_username' => $new_username]);
            $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existing_user) {
                $_SESSION['error'] = "The new username is already taken.";
            } else {
                $stmt = $conn->prepare("UPDATE users SET username = :new_username WHERE id = :user_id");
                $stmt->execute(['new_username' => $new_username, 'user_id' => $_SESSION['user_id']]);
                $_SESSION['success'] = "Username successfully updated.";
            }
        }
    }

header("Location: updateProfile.php");

}
?>
