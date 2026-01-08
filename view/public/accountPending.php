<?php
session_start();
$_SESSION['page'] = 'accountPending';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Account Pending Approval</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php
    include '../includes/header.php';
    ?>
    <main class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-md text-center">


            <div class="flex justify-center mb-4">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-green-100 text-green-600 text-2xl">
                    ✓
                </div>
            </div>


            <h1 class="text-2xl font-semibold text-gray-800 mb-2">
                Hello Mr.<span class="text-green-600">
                    <?= isset($_SESSION['userName']) && !empty($_SESSION['userName']) ? htmlspecialchars($_SESSION['userName']) : 'User' ?>
                </span>
            </h1>

            <p class="text-gray-600 mb-4">
                Your account has been created successfully 🎉
            </p>

            <p class="text-sm text-gray-500 mb-6">
                Your account is currently <span class="font-medium text-gray-700">pending approval</span>.
                Please wait while an administrator reviews and activates your account.
            </p>


            <div class="inline-block px-4 py-2 text-sm rounded-full bg-yellow-100 text-yellow-700">
                Status: Waiting for admin validation
            </div>


            <p class="mt-6 text-xs text-gray-400">
                You will be able to log in once your account is approved.
            </p>

        </div>
    </main>
    <?php include "../includes/footer.php" ?>
</body>

</html>