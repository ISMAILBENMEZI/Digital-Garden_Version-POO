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
    width: 100%;
    border-collapse: collapse;
    background-color: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

th {
    background-color: #f4f6f8;
    color: #333;
    padding: 12px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 14px;
}


td {
    padding: 12px;
    border-top: 1px solid #eaeaea;
    text-align: center;
    color: #444;
}


tr:hover {
    background-color: #f9f9f9;
}


form {
    display: flex;
    justify-content: center;
    gap: 8px;
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
