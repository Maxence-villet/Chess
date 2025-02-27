<?php
session_start();
$_SESSION['player_id'] = 1;
$_SESSION['nickname'] = 'TestUser';
header('Location: index.php');
exit;
?>