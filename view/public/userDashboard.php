<?php
require_once __DIR__ . '/../../vendor/autoload.php';
session_start();
$_SESSION['page'] = "userDashboard";
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

    <main class="dash_main px-6 py-6" id="userMain">
        <aside class="My_themes">
            <h2>
                My Theme
            </h2>
            <a href="theme.php" class="add_theme_btn">
                <img src="IMG/add_14360946.png" alt="" width="20px">
                Add New Theme
            </a>
            <div class="the_myThemes grid grid-cols-1 gap-4">
                <?php if (empty($_SESSION['themes'])): ?>
                    <div class="flex justify-center items-center h-32 bg-gray-100 rounded-lg shadow-md">
                        <p class="text-gray-500 text-lg font-medium">No themes present so far!</p>
                    </div>
                <?php else: ?>

                    <?php foreach ($_SESSION['themes'] as $theme): ?>
                        <div class="theme relative p-4 rounded-xl shadow-sm transition-all duration-300 hover:shadow-md"
                            style="background: linear-gradient(135deg, #fff 0%, <?= htmlspecialchars($theme->Color) ?> 100%);">

                            <div class="flex justify-between items-start">
                                <div class="flex items-center gap-3">
                                    <img src="<?= $_SESSION['user']->getImgUrl() ?? '../IMG/default_user.png' ?>"
                                        alt="User"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm">

                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 font-bold uppercase tracking-wide">
                                            <?= $_SESSION['user']->getName()?? 'Me' ?>
                                        </span>
                                        <h5 class="font-bold text-gray-800 text-lg capitalize leading-tight">
                                            <?= htmlspecialchars($theme->name) ?>
                                        </h5>
                                    </div>
                                </div>

                                <button onclick="toggleDropdown('menu-<?= $theme->id ?>')"
                                    class="text-gray-500 hover:text-black focus:outline-none p-1 rounded-full hover:bg-white/50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </button>
                            </div>

                            <div id="menu-<?= $theme->id ?>"
                                class="hidden absolute right-4 top-12 w-48 bg-white rounded-xl shadow-xl z-50 border border-gray-100 overflow-hidden fade-in-menu">

                                <form method="post" action="/Digital-Garden_Version-POO/theme/ViewNote" class="w-full">
                                    <input name="theme_id" value="<?= htmlspecialchars($theme->id) ?>" type="hidden" />
                                    <button type="submit" name="viewNote" class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition">
                                        <img src="../public_assets/IMG/visible_3811523.png" alt="" class="w-5 h-5">
                                        View Notes
                                    </button>
                                </form>

                                <a href="note.php?theme_id=<?= htmlspecialchars($theme->id) ?>"
                                    class="block w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition border-t border-gray-100">
                                    <img src="../public_assets/IMG/interface_15478767.png" alt="" class="w-5 h-5">
                                    Add Note
                                </a>

                                <form method="post" action="/Digital-Garden_Version-POO/theme/modifyTheme" class="w-full border-t border-gray-100">
                                    <input name="id" value="<?= htmlspecialchars($theme->id) ?>" type="hidden" />
                                    <button type="submit" name="modify" value="modify" class="w-full text-left px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 flex items-center gap-2 transition">
                                        <img src="../public_assets/IMG/pencil_10053970.png" alt="" class="w-5 h-5">
                                        Modify
                                    </button>
                                </form>

                                <form method="post" action="/Digital-Garden_Version-POO/theme/deleteTheme" class="w-full border-t border-gray-100">
                                    <input name="id" value="<?= htmlspecialchars($theme->id) ?>" type="hidden" />
                                    <button type="submit" name="delete" value="delete" onclick="return confirm('Are you sure?')"
                                        class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2 transition">
                                        <img src="../public_assets/IMG/trash-bin_12225534.png" alt="" class="w-5 h-5">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </aside>
        <section class="my_Notes">
            <?php if (empty($_SESSION['themes'])): ?>
                <div class="flex justify-center">
                    <div class="modal">
                        <div class="modal_log">
                            <h1>Digital Garden</h1>
                            <div>
                                Create themes, organize your thoughts, and start building ideas that grow over time. Add notes, connect concepts, and manage your projects in a calm and structured space. Everything you need to stay focused and productive is right here.
                            </div>
                        </div>
                        <div>
                            <img src="../IMG/Gemini_Generated_Image_69qsfj69qsfj69qs.png" alt="">
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <h2>My Notes</h2>
                <form method="post" action="/Digital-Garden_Version-POO/UserDashboard/raingNote" class="raing">
                    <input name="theme_id" value="<?= $_SESSION['ratingTheme_id'] ?? '' ?>" type="hidden" />
                    <input value="Top Rated" name="raingNote" type="submit" />
                </form>
                <?php if (!empty($_SESSION['note'])): ?>
                    <div class="notes_list">
                        <?php foreach ($_SESSION['note'] as $note): ?>
                            <div class="note">
                                <div class="note_titleDate">
                                    <h3>title:<?= htmlspecialchars($note->title) ?></h3>
                                    <h5><?= htmlspecialchars($note->creation_date) ?></h5>
                                </div>
                                <div class="note_buttons">
                                    <form method="POST" action="/Digital-Garden_Version-POO/UserDashboard/modifyNote">
                                        <input name="note_id" value="<?= htmlspecialchars($note->id) ?>" type="hidden" />
                                        <input value="modify" name="modify" type="submit" />
                                    </form>

                                    <form method="POST" action="/Digital-Garden_Version-POO/UserDashboard/deleteNote">
                                        <input name="note_id" value="<?= htmlspecialchars($note->id) ?>" type="hidden" />
                                        <input value="delete" name="delete" type="submit" onclick="return confirm('Are you sure?')" />
                                    </form>
                                    <div class="StarRating">
                                        <?php for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= htmlspecialchars($note->importance)) {
                                                echo '<span class="starRat">★</span>';
                                            } else {
                                                echo '<span class="starEmpty">★</span>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="note_content">
                                    <p><?= htmlspecialchars($note->content) ?></p>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>

                <?php else: ?>
                    <div class="flex justify-center items-center h-32 bg-gray-100 rounded-lg shadow-md">
                        <p class="text-gray-500 text-lg font-medium">No Notes present so far!</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </main>
    <?php require_once "../includes/footer.php"; ?>
    <script src="../public_assets/userDashbord.js"></script>
</body>

</html>