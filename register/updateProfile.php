<?php
session_start();
require_once 'database.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="updateProfile.css">
</head>    
<body>

    <section>
        <h1>MY ACCOUNT</h1> 

        <?php
           if (isset($_SESSION['error'])) {
                echo '<div class="error-message">' . htmlspecialchars($_SESSION['error']) . '</div>';
               unset($_SESSION['error']);
               } elseif (isset($_SESSION['success'])) {
               echo '<div class="success-message">' . htmlspecialchars($_SESSION['success']) . '</div>'; 
               unset($_SESSION['success']); }
        ?>

        <nav class="acc">
            <nav class="usern">
                <p>Update your username</p>
                <form method="POST" action="checkProfile.php">
                <input type="username" name="current_username" placeholder=" Current username" required id="user"/>
                <input type="username" name="new_username" placeholder="  New username" required id="user"/>
                <input type="username" name= "confirm_new_username" placeholder="  Confirm new username" required id="user"/>
                <input type="submit" value="Confirm"name= "update_name" id="conf"/>
                </form>
            </nav>

            <nav class="pic">
                <p>Update your profile picture</p>
                <form method="POST" action="picture.php" enctype="multipart/form-data">
                <label for="profile_picture">Select a new profile picture :</label>
                <input type="file" name="profile_picture" id="profile_picture" required>
                <button type="submit" class="button">Download</button>
                </form>
            </nav>

            <nav class="logout">
                <form method="POST" action="logout.php">
                <button type="submit" class="logout-btn">Logout</button>
                </form>
            </nav>
        </nav>    
    </section>
</body>
</html>