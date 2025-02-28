<?php
require 'functions.php';

// Récupérer tous les utilisateurs
$users = getUsers();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau d'administration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Panneau d'administration</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><img src="https://via.placeholder.com/50" alt="Avatar" class="rounded-circle" width="50" height="50"></td>
                    <td><?php echo $user['username'] ? htmlspecialchars($user['username']) : 'Admin'; ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo $user['is_blocked'] ? 'Bloqué' : 'Actif'; ?></td>
                    <td>
                        <?php if ($user['is_blocked']): ?>
                            <a href="toggle_block.php?id=<?php echo $user['id']; ?>&action=unblock" class="btn btn-success btn-sm">Débloquer</a>
                        <?php else: ?>
                            <a href="toggle_block.php?id=<?php echo $user['id']; ?>&action=block" class="btn btn-warning btn-sm">Bloquer</a>
                        <?php endif; ?>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>