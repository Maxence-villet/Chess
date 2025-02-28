<?php

require_once("../config/database.php");



$pdo = Database::connectToDatabase();
$action = $_GET['action'];

if ($action == 'select') {
    
    $sql = "SELECT pawns FROM games";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();

    if ($result->num_rows > 0) {
        return $result;
    } else {
        return "not found";
    }
} elseif ($action == 'insert') {
    $pawns = $_POST['pawns'];
    $sql = "UPDATE INTO games (pawns) VALUES ('$pawns')";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    if ($result) {
        return "Nouvel update créé avec succès";
    } else {
        return "Erreur: " . $sql . "<br>"; 
    }
} elseif ($action == 'create') {
    try {
        $id = $_POST["id"];
        $pawns = $_POST("pawns");
        $sql = "INSERT INTO games (id, pawns) VALUES ('$id', '$pawns')";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();
    } catch (PDOException $e) {
        echo $e;
    }
    
}

$conn->close();
?>