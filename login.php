<?php include "config/database.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $message = [];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === '') {
        $message[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Invalid email format';
    }

    if ($password === '') {
        $message[] = 'Password is required';
    } elseif (strlen($password) < 6) {
        $message[] = "Password must be at least 6 characters";
    }

    if (empty($message)) {
        $sql = "SELECT * FROM utilisateur WHERE email = ?";
        $stm = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stm, "s", $email);
        mysqli_stmt_execute($stm);

        $result = mysqli_stmt_get_result($stm);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user["password"])) {
                $_SESSION['userId'] = $user["id"];
                $_SESSION['username'] = $user["name"];
                $_SESSION['login_time'] = time();

                setcookie("user_id" , $user['id'], time() + 100000,"/");
                setcookie("username",$user['name'], time() + 100000 , "/");

                header("location: dashboard.php");
                exit();
            } else {
                $_SESSION['error'] = "Invalid email or password";
                header("location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid email or password";
            header("location: login.php");
            exit();
        }
    } else {
        $_SESSION['messages'] = $message;
        header("location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="public/output.css">
</head>

<body>
    <?php
    $page = "login";
    require_once "includes/header.php";
    ?>
    <article class="messag">
        <div class="good" id="good"></div>
        <div class="bad" id="bad"></div>
    </article>

    <article class="php_messag">
        <?php if (isset($_SESSION['messages'])): ?>
            <?php foreach ($_SESSION['messages'] as $msg): ?>
                <div class="php_bad"><?= htmlspecialchars($msg) ?></div>
                <?php unset($_SESSION['messages']); ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="php_bad" id="flash_message"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </article>
    <main class="min-h-screen flex items-center justify-center bg-white">
        <div class="w-full max-w-md p-8 border border-green-200 rounded-2xl shadow-sm">

            <h1 class="text-2xl font-semibold text-green-700 text-center mb-6">
                Log in
            </h1>

            <form class="space-y-4" id="loginForm" method="POST" action="login.php">

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

                <input type="submit" value="submit" name="login"
                    class="w-full mt-4 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-200 cursor-pointer">
            </form>
        </div>
    </main>

    <?php require_once "includes/footer.php" ?>
    <script src="public/login.js"></script>
</body>

</html>