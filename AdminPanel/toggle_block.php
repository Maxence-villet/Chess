<?php
require 'functions.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $userId = $_GET['id'];
    $action = $_GET['action'];
    toggleUserBlock($userId, $action);
}

header('Location: dashboard.php');
exit;
?>