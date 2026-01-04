<?php
session_start();
include "../Controller/themeController.php";
$themes = affichaeTheme($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public_assets/userDashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body>
    <?php
    $page = "userDashboard";
    require_once "../includes/header.php";
    ?>
    <article class="php_messag">
        <div class="php_bad" id="flash_message" style="color: rgb(4, 255, 0);"></div>
    </article>
    <main class="dash_main px-6 py-6" id="userMain">
        <aside class="My_themes">
            <h2>
                My Theme
            </h2>
            <a href="theme.php" class="add_theme_btn">
                <img src="IMG/add_14360946.png" alt="" width="20px">
                Add New Theme
            </a>
            <div class="the_myThemes">
                <?php if (empty($themes)): ?>
                    <div class="flex justify-center items-center h-32 bg-gray-100 rounded-lg shadow-md">
                        <p class="text-gray-500 text-lg font-medium">No themes present so far!</p>
                    </div>
                <?php endif ?>
                <?php foreach ($themes as $theme): ?>
                    <div class="theme" style="background: linear-gradient(135deg, #fff 0%, <?= $theme['Color'] ?> 100%);">
                        <div class="card-body">
                            <h5 class="card-title text-black">Title:<?= $theme['name'] ?></h5>
                            <form method="post" action="includes/noteAuth.php">
                                <input name="theme_id" value="<?= $theme['id'] ?>" type="hidden" />
                                <input value="View Note" name="viewNote" type="submit" />
                            </form>
                        </div>
                        <div class="buttons">
                            <form method="post" action="../Controller/themeController.php">
                                <input name="id" value="<?= $theme['id'] ?>" type="hidden" />
                                <input value="modify" name="modify" type="submit" />
                            </form>

                            <form method="post" action="../Controller/themeController.php">
                                <input name="id" value="<?= $theme['id'] ?>" type="hidden" />
                                <input value="delete" name="delete" type="submit" />
                            </form>

                            <div><a href="notes.php?theme_id=<?= $theme['id'] ?>" class="Add_Note_btn"><img src="IMG/add_14360946.png" alt="" width="20px">Add New Note</a></div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </aside>
        <section class="my_Notes">
            <!-- <div class="flex justify-center">
                <div class="modal">
                    <div class="modal_log">
                        <h1>Digital Garden</h1>
                        <div>
                            Create themes, organize your thoughts, and start building ideas that grow over time. Add notes, connect concepts, and manage your projects in a calm and structured space. Everything you need to stay focused and productive is right here.
                        </div>
                    </div>
                    <div>
                        <img src="./IMG/Gemini_Generated_Image_69qsfj69qsfj69qs.png" alt="">
                    </div>
                </div>
            </div> -->
            <h2>My Notes</h2>
            <form method="post" action="includes/noteAuth.php" class="raing">
                <input name="theme_id" value="" type="hidden" />
                <input value="Top Rated" name="raingNote" type="submit" />
            </form>
            <div class="notes_list">
                <div class="note">
                    <div class="note_titleDate">
                        <h3>title:</h3>
                        <h5></h5>
                    </div>
                    <div class="note_buttons">
                        <form method="POST" action="includes/noteAuth.php">
                            <input name="note_id" value="" type="hidden" />
                            <input value="modify" name="modify" type="submit" />
                        </form>

                        <form method="POST" action="includes/noteAuth.php">
                            <input name="note_id" value="" type="hidden" />
                            <input value="delete" name="delete" type="submit" />
                        </form>
                        <div class="StarRating">
                        </div>
                    </div>
                    <div class="note_content">
                        <p></p>
                    </div>
                </div>
            </div>
            <!-- <div class="flex justify-center items-center h-32 bg-gray-100 rounded-lg shadow-md">
                <p class="text-gray-500 text-lg font-medium">No Notes present so far!</p>
            </div> -->
        </section>
    </main>
</body>

</html>