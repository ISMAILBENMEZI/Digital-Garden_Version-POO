<?php
session_start();
$_SESSION['page'] = "adminDashbord";

// Security Check
if (!isset($_SESSION['user']) || $_SESSION['user']->role_id !== 2) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../public_assets/dashboard.css?v=2">
</head>

<body>

    <?php require_once "../includes/header.php"; ?>

    <div class="php_messag">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="php_good" id="good">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="php_bad" id="bad">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </div>

    <div class="container">
        <h2>Admin Dashboard</h2>

        <div class="tab-controls">
            <button id="btn-users" class="tab-btn active" onclick="openTab('users')">Manage Users</button>
            <button id="btn-reports" class="tab-btn" onclick="openTab('reports')">Manage Reports</button>
        </div>

        <div id="view-users" class="card">
            <h3>User Management</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['users'])): ?>
                        <?php foreach ($_SESSION['users'] as $user): ?>
                            <tr>
                                <td><?= $user->id ?></td>
                                <td><?= htmlspecialchars($user->name) ?></td>
                                <td><?= htmlspecialchars($user->email) ?></td>

                                <td>
                                    <span class="statut-<?= $user->statut ?>">
                                        <?= ucfirst($user->statut) ?>
                                    </span>
                                </td>

                                <td>
                                    <form method="POST" action="/Digital-Garden_Version-POO/dashboard/UpdateStatut">
                                        <input type="hidden" name="user_id" value="<?= $user->id ?>">
                                        <select name="statut">
                                            <option value="pending" <?= $user->statut == 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="active" <?= $user->statut == 'active' ? 'selected' : '' ?>>Active</option>
                                            <option value="blocked" <?= $user->statut == 'blocked' ? 'selected' : '' ?>>Blocked</option>
                                        </select>
                                        <button type="submit">Save</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div id="view-reports" class="card hidden">
            <h3>Report Management</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Reporter</th>
                        <th>Reported ID</th>
                        <th>Theme</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['reports'])): ?>
                        <?php foreach ($_SESSION['reports'] as $report): ?>
                            <tr>
                                <td><?= $report->id ?></td>
                                <td><?= htmlspecialchars($report->report_type) ?></td>
                                <td><?= htmlspecialchars($report->reporter_name) ?></td>
                                <td><?= $report->reported_user_id ?></td>
                                <td><?= $report->report_theme_id ?></td>

                                <td class="status-<?= $report->status ?>">
                                    <?= ucfirst(str_replace('_', ' ', $report->status)) ?>
                                </td>

                                <td>
                                    <form method="POST" action="/Digital-Garden_Version-POO/dashboard/UpdateRepor">
                                        <input type="hidden" name="report_id" value="<?= $report->id ?>">
                                        <select name="status">
                                            <option value="pending" <?= $report->status == 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="under_review" <?= $report->status == 'under_review' ? 'selected' : '' ?>>Under Review</option>
                                            <option value="resolved" <?= $report->status == 'resolved' ? 'selected' : '' ?>>Resolved</option>
                                            <option value="dismissed" <?= $report->status == 'dismissed' ? 'selected' : '' ?>>Dismissed</option>
                                        </select>
                                        <button type="submit">Save</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No reports found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

    <?php include "../includes/footer.php" ?>
    <script src="../public_assets/dashboard.js"></script>
</body>

</html>