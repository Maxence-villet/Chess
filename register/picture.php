<?php
session_start();
require_once 'Database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_FILES['profile_picture'])) {
    $uploadDir = '../profile_pictures/';

    $fileExtension = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($fileExtension, $allowedExtensions)) {
        $_SESSION['error'] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
    elseif ($_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "Error uploading the file.";
    }
    else {
        $FileName =  basename($_FILES['profile_picture']['name']);
        $targetFilePath = $uploadDir . $FileName;

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            if ($conn) {
                $stmt = $conn->prepare("UPDATE users SET profile_picture_path = :profile_picture_path WHERE id = :user_id");
                $stmt->execute([
                    'profile_picture_path' => $FileName, 
                    'user_id' => $_SESSION['user_id']
                ]);

                if ($stmt->rowCount() > 0) {
                    $_SESSION['success'] = "Profile picture updated successfully!";
                }
            } else {
                $_SESSION['error'] = "Failed to connect to the database.";
            }
        } else {
            $_SESSION['error'] = "Error moving the uploaded file.";
        }
    }
} else {
    $_SESSION['error'] = "No file uploaded.";
}

header("Location: updateProfile.php");

?>