<?php
if (isset($_GET['theme_id'])) {
    $theme_id = $_GET['theme_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public_assets/note.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>


<body>
    <?php
    $page = 'notes';
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
        <div class="w-full max-w-md p-8 bg-white border border-gray-200 rounded-2xl shadow-lg">

            <h1 class="text-2xl font-semibold text-gray-800 text-center mb-6">
                Add New Note
            </h1>

            <form method="POST" action="../Controller/noteController.php" id="noteForm">
                <input type="hidden" name="theme_id" value="<?= $theme_id ?? $_SESSION['theme_id']  ?>">

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Title
                    </label>
                    <input
                        type="text"
                        id="noteTitle"
                        name="Title"
                        value="<?= $_SESSION['updateNoteTitle'] ?? "" ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Content
                    </label>
                    <textarea
                        id="notecontent"
                        name="Content"
                        rows="8"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        resize-y"
                        placeholder="Write your note here..."><?= $_SESSION['updateNoteContent'] ?? "" ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Rating
                    </label>

                    <div class="rating">
                        <input type="radio" name="rating" id="star5" value="5">
                        <label for="star5">★</label>

                        <input type="radio" name="rating" id="star4" value="4">
                        <label for="star4">★</label>

                        <input type="radio" name="rating" id="star3" value="3">
                        <label for="star3">★</label>

                        <input type="radio" name="rating" id="star2" value="2">
                        <label for="star2">★</label>

                        <input type="radio" name="rating" id="star1" value="1">
                        <label for="star1">★</label>
                    </div>
                </div>

                <input type="hidden" name="note_id" value="<?= $_SESSION['updateNoteId'] ?? "" ?>" />
                <input
                    type="submit"
                    value="<?= isset($_SESSION['updateNoteId']) ? "Update" : 'Submit' ?>"
                    name="<?= isset($_SESSION['updateNoteId']) ? "UpdateNote" : 'addNote' ?>"
                    class=" py-2 w-full mt-4 bg-blue-600 text-white rounded-xl
                       font-medium hover:bg-blue-700 transition cursor-pointer">
            </form>
        </div>
    </main>
    <script src="../public_assets/script.js"></script>
</body>

</html>

</html>