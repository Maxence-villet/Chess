<?php
require '../config/database.php';

function getUsers() {
    $query = "SELECT u.id, u.email, u.is_blocked, p.username 
              FROM users u 
              LEFT JOIN player_profiles p ON u.id = p.user_id";
    $pdo = Database::connectToDatabase();
    $statement = Database::executeQuery($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function toggleUserBlock($userId, $action) {
    $isBlocked = $action === 'block' ? 1 : 0;
    $query = "UPDATE users SET is_blocked = :is_blocked WHERE id = :id";
    Database::executeQuery($query, ['is_blocked' => $isBlocked, 'id' => $userId]);
}

function deleteUser($userId) {
    $query = "DELETE FROM users WHERE id = :id";
    Database::executeQuery($query, ['id' => $userId]);
}
?>