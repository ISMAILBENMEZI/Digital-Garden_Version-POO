<?php
require '../Controller/adminController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            height: 100Vh;
        }
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
        header {
            position: relative;
            top: 0;
        }
        footer {
            position: relative;
            bottom: 0;
        }
        


    </style>
</head>
<body>
<?php 
$page = 'login';
include '../includes/header.php';
?>
<h2>users table</h2>
<?php if(!empty($_SESSION['message'])) :?>
    <p id="message" style="color:green"><?= htmlspecialchars($_SESSION['message'])?></p>
    <?php unset($_SESSION['message']) ?>
<?php endif ?>

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
<?php 
$page = 'login';
include '../includes/footer.php';
?>
<script>
    setTimeout( ()=>{
        const msg = document.getElementById('message');
        if(msg){
            msg.style.display = "none";
        }
    },2000

    )
</script>
</body>
</html>
