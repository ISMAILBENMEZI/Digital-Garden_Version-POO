<?php
session_start();
$_SESSION['page'] = 'login';
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="../public_assets/login.php">
</head>

<body>
    <?php
    require_once "../includes/header.php";
    ?>
    <article class="php_messag">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="php_good" id="good" style="color: rgb(4, 255, 0);"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </article>

    <article class="php_messag">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="php_bad" id="bad" style="color: rgba(255, 0, 0, 1);"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </article>
    <main class="min-h-screen flex items-center justify-center bg-white">
        <div class="w-full max-w-md p-8 border border-green-200 rounded-2xl shadow-sm">

            <h1 class="text-2xl font-semibold text-green-700 text-center mb-6">
                Log in
            </h1>

            <form class="space-y-4" id="loginForm" method="POST" action="../login.php">

                <div>
                    <label class="block text-green-700 mb-1">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-green-700 mb-1">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <?php if (!empty($errors)): ?>
                    <ul style="color:red;">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <input type="submit" value="submit" name="login"
                    class="w-full mt-4 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-200 cursor-pointer">
            </form>
        </div>
    </main>

    <?php require_once "../includes/footer.php" ?>
    <script src="public/login.js"></script>
    <script src="../public_assets/script.js"></script>
</body>

</html>