<?php include "config/database.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createAccount'])) {

    $message = [];

    $name = trim($_POST['userName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirmPassword'];

    if ($name === '') {
        $message[] = 'Name is required';
    } elseif (strlen($name) < 3) {
        $message[] = 'Name must be at least 3 characters';
    }

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

    if ($confirm === '') {
        $message[] = "Please confirm your password";
    } elseif ($password !== $confirm) {
        $message[] = "Passwords do not match";
    }


    $stm = $conn->prepare("SELECT id FROM utilisateur WHERE email = ?");
    $stm->bind_param("s", $email);
    $stm->execute();

    $result = $stm->get_result();

    if ($result->num_rows > 0) {
        $message[] =  "This email is already registered";
        $_SESSION['error'] = "This email is already registered";
        header("location: login.php");
        exit;
    }

    $stm->close();

    if (empty($message)) {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $registrationDate = date("Y-m-d H:i:s");
        $stm = $conn->prepare("INSERT INTO utilisateur(name , email,registration_date,password) VALUES(?,?,?,?)");
        $stm->bind_param("ssss", $name, $email, $registrationDate, $hashPassword);

        if ($stm->execute()) {
            $user_id = mysqli_insert_id($conn);

            $_SESSION['success'] = "Account created successfully";
            $_SESSION['userId'] = $user_id;
            $_SESSION['username'] = $name;
            $_SESSION['login_time'] = time();

            $stm->close();
            header("location: dashboard.php");
            exit;
        } else {
            $stm->close();
            $message[] = "Registration failed. Please try again.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="public/output.css">
</head>

<body>
    <?php
    $page = 'register';
    require_once "includes/header.php";
    ?>
    <article class="messag">
        <div class="good" id="good"></div>
        <div class="bad" id="bad"></div>
    </article>

    <article class="php_messag">
        <?php if (!empty($message)): ?>
            <?php foreach ($message as $msg): ?>
                <div class="php_bad"><?= htmlspecialchars($msg) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </article>

    <main class="min-h-screen flex items-center justify-center bg-white">
        <div class="w-full max-w-md p-8 border border-green-200 rounded-2xl shadow-sm">

            <h1 class="text-2xl font-semibold text-green-700 text-center mb-6">
                Create Account
            </h1>

            <form class="space-y-4" id="from" method="POST" action="register.php">

                <div>
                    <label class="block text-green-700 mb-1">Name</label>
                    <input type="text" id="userName" name="userName"
                        class="w-full px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-green-700 mb-1">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-green-700 mb-1">Create Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-green-700 mb-1">Enter Password Again</label>
                    <input type="password" id="confirmPassword" name="confirmPassword"
                        class="w-full px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <input type="submit" value="submit" name="createAccount"
                    class="w-full mt-4 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-200 cursor-pointer">

            </form>
        </div>
    </main>

    <?php require_once "includes/footer.php" ?>

    <script src="public/register.js"></script>
</body>

</html>