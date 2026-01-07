<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public_assets/register.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

    <?php
    session_start();
    $page = 'register';
    require_once "../includes/header.php";
    ?>
    <article class="php_messag">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="php_good" id="flash_message" style="color: rgb(4, 255, 0);"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </article>
    <article class="php_messag">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="php_bad" style="color: rgba(255, 0, 0, 1);"><?= htmlspecialchars($_SESSION['errors']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </article>
    <main class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="w-full max-w-md p-8 bg-white border border-gray-200 rounded-2xl shadow-md">

            <h1 class="text-3xl font-semibold text-gray-800 text-center mb-2">
                Create Account
            </h1>
            <p class="text-center text-sm text-gray-500 mb-6">
                Join us and start your journey
            </p>

            <form class="space-y-4" id="form" method="POST" action="../../route.php">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Name
                    </label>
                    <input type="text" id="userName" name="userName"
                        placeholder="Your full name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-green-500
                           focus:border-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input type="email" id="email" name="email"
                        placeholder="example@email.com"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-green-500
                           focus:border-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input type="password" id="password" name="password"
                        placeholder="••••••••"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-green-500
                           focus:border-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Confirm Password
                    </label>
                    <input type="password" id="confirmPassword" name="confirmPassword"
                        placeholder="••••••••"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-green-500
                           focus:border-green-500">
                </div>

                <button type="submit" name="createAccount"
                    class="w-full mt-4 bg-green-600 text-white py-2.5 rounded-lg font-medium
                       hover:bg-green-700 transition duration-200">
                    Create Account
                </button>
            </form>
        </div>
    </main>
    <?php require_once "../includes/footer.php" ?>
    <script src="../public_assets/script.js"></script>
</body>

</html>