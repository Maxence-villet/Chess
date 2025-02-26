<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
</head>    
<body>

    <section>
        <h1>LOGIN</h1> 

        <?php
        if (isset($_SESSION['error'])) {
            echo '<p class="error-message">' . htmlspecialchars($_SESSION['error']) . '</p>';
            unset($_SESSION['error']);
        } elseif (isset($_SESSION['messagelogin'])) {
            echo '<p class="success-message">' . htmlspecialchars($_SESSION['messagelogin']) . '</p>';
            unset($_SESSION['messagelogin']);
        }
        ?>
        
        <form method="POST" action="checkLogin.php">
            <input type="email" name="email" placeholder="  Email" required id="em"/>
            <input type="password" name="password" placeholder="  Password" required id="pas"/>
            <input type="submit" name="submitForm" value="Login" id="log"/>
        </form>
    </section>

</body>
</html>