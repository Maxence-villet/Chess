<?php
session_start();

if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [
        ['nickname' => 'TestUser', 'message' => 'Salut !', 'date' => date("Y-m-d H:i:s", strtotime('-1 hour'))],
        ['nickname' => 'AutreUser', 'message' => 'Coucou !', 'date' => date("Y-m-d H:i:s", strtotime('-30 minutes'))]
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'] ?? '';

    if (trim($message) === '') {
        echo json_encode(['success' => false, 'message' => 'Le message est vide.']);
        exit;
    }

    $_SESSION['messages'][] = [
        'nickname' => $_SESSION['nickname'],
        'message' => htmlspecialchars($message),
        'date' => date("Y-m-d H:i:s")
    ];
    echo json_encode(['success' => true, 'message' => 'Message enregistré (simulation).']);
    exit;
}

function getMessages() {
    return $_SESSION['messages'];
}

echo json_encode(getMessages());
?>