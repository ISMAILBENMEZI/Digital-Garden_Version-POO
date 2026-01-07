<?php
session_start();
$_SESSION['page'] = "adminDashbord";
require '../Controller/adminController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../public_assets/dashboard.css">
</head>

<body>
    <?php
    require_once "../includes/header.php";
    ?>
    <div class="container">
        <h2>Users Dashboard</h2>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>STATUS</th>
                        <th>CHANGE STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= htmlspecialchars($user->name) ?></td>
                            <td><?= htmlspecialchars($user->email) ?></td>
                            <td class="
                            <?= $user->statut === 'active' ? 'statut-active' : '' ?>
                            <?= $user->statut === 'pending' ? 'statut-pending' : '' ?>
                            <?= $user->statut === 'blocked' ? 'statut-blocked' : '' ?>
                            ">
                            <?= ucfirst($user->statut) ?>
                            </td>
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
        </div>
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>THEME</th>
                        <th>REPORTER</th>
                        <th>REPORTED</th>
                        <th>REPORT TYPE</th>
                        <th>CHANGE STATUS</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    
    <?php include "../includes/footer.php" ?>
</body>

</html>