<!DOCTYPE html>
<html lang="en">
<? session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public_assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>


<body>
    <?php
    $page = "themes";
    require_once "../includes/header.php";
    ?>
    <main class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="w-full max-w-md p-8 bg-white border border-gray-200 rounded-2xl shadow-lg">

            <h1 class="text-2xl font-semibold text-gray-800 text-center mb-6">
                Add New Theme
            </h1>

            <form method="POST" action="../Controller/themeController.php" id="themeForm">

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Title
                    </label>
                    <input
                        type="text"
                        id="themeTitle"
                        name="Title"
                        value="<?= $_SESSION['updateTitle'] ?? "" ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <input
                        type="color"
                        id="themeColor"
                        name="color"
                        value="<?= $_SESSION['updateColor'] ?? "" ?>"
                        class="w-full h-14 cursor-pointer appearance-none"
                        style="border-radius: 10px;" />
                </div>

                <input type="hidden" name="id" value="<?= $_SESSION['updateId'] ?? '' ?>" />
                <input
                    type="submit"
                    value="<?= isset($_SESSION['updateId']) ? 'Update' : 'Submit' ?> "
                    name="<?= isset($_SESSION['updateId']) ? 'updateTheme' : 'addTheme' ?>"
                    class=" py-2 w-full mt-4 bg-blue-600 text-white rounded-xl
                       font-medium hover:bg-blue-700 transition cursor-pointer">
            </form>
        </div>
    </main>
    <?php include "../includes/footer.php" ?>
    <script src="../public_assets/script.js"></script>
</body>

</html>

</html>