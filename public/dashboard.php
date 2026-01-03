<?php
require '../Controller/adminController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        table {
             border-collapse: collapse;
             width: 100%;
             }
        th, td {
             border: 1px solid #ccc;
             padding: 8px;
             text-align: center;
             }
        th { background: #eee; }
        form { display: inline; }
    </style>
</head>
<body>

<h2>Users Dashboard</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Statut</th>
            <th>Change Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= htmlspecialchars($user->name) ?></td>
                <td><?= htmlspecialchars($user->email) ?></td>
                <td><?= $user->statut ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="<?= $user->id ?>">
                        <select name="statut">
                            <option value="pending" <?= $user->statut === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="active" <?= $user->statut === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="blocked" <?= $user->statut === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
