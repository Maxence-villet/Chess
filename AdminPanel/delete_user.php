<?php
require 'functions.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    deleteUser($userId);
}

header('Location: index.php');
exit;
?>