<?php
$page = 'dashboard';
include "includes/auth.php";

if (!isset($_SESSION['username'])) {
    header("location: includes/auth.php?logout=1");
    exit();
}

if (isset($_SESSION['notes'])) {
    $notes = $_SESSION['notes'];
    unset($_SESSION['notes']);
} else {
    $notes = [];
}

$themes = affichaeTheTheme($conn);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/output.css">
    <style>
        main {
            max-width: 1500px;
            margin: 0 auto;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .My_themes {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            min-width: 280px;
            max-width: 400px;
            flex: 1;
            height: 100vh;
            overflow-y: auto;
        }

        .My_themes h2 {
            color: #58628d;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .add_theme_btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #00FF00 0%, #025904 100%);
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .add_theme_btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(6, 99, 6, 0.4);
        }

        .the_myThemes {
            max-width: 600px;
        }

        .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 17px;
            font-weight: 700;
            color: #374151;
            text-transform: capitalize;
        }

        .theme {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 12px;
            transition: all 0.3s;
            position: relative;
        }

        .theme:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .theme .buttons {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .theme input[type="submit"][value="modify"],
        .theme input[type="submit"][value="delete"],
        .theme input[type="submit"][value="View Note"] {
            background-color: #2563eb;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .theme input[type="submit"][value="delete"] {
            background-color: #FF0000;
        }

        .theme input[type="submit"][value="View Note"] {
            background-color: #8800FF;
        }

        .Add_Note_btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            background: linear-gradient(135deg, #00FF00 0%, #025904 100%);
            color: white;
            font-size: 14px;
            font-weight: 500;
            font-weight: bold;
            transition: all 0.3s;
            padding: 7px;
            border-radius: 10px;
        }

        .my_Notes {
            flex: 2;
            height: 100%;
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            min-width: 280px;
            max-width: 1000px;
            flex: 1;
            height: 100vh;
            overflow-y: auto;
        }

        .my_Notes h2 {
            color: #58628d;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .my_Notes .notes_list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 10px;
        }

        .note {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            gap: 10px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 12px;
            transition: all 0.3s;
            position: relative;
        }

        .note:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(6, 99, 6, 0.4);
        }


        .note_titleDate {
            display: flex;
            justify-content: space-between;
            color: black;
            font-weight: 500;
        }

        .note_titleDate h3 {
            font-size: 16px;
            font-weight: 900;
            text-transform: capitalize;
        }

        .note_buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .note input[type="submit"][value="modify"],
        .note input[type="submit"][value="delete"] {
            background-color: #2563eb;
            font-size: 16px;
            color: white;
            font-weight: 500;
            padding: 5px 25px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .note input[type="submit"][value="delete"] {
            background-color: #FF0000;
        }

        .note input[type="submit"][value="modify"]:hover,
        .note input[type="submit"][value="delete"]:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
        }

        .note_content p {
            font-size: 15px;
            font-weight: 500;
            color: black;
        }

        .starRat {
            font-size: 24px;
            color: #fbbf24;

        }

        .starEmpty {
            font-size: 24px;
            color: #4A4A4A;
        }

        .raing input[type="submit"][value="Top Rated"] {
            background-color: #4A4A4A;
            font-size: 16px;
            color: white;
            font-weight: 500;
            padding: 5px 25px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    $page = "dashboard";
    require_once "includes/header.php";
    ?>

    <article class="php_messag">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="php_bad" id="flash_message" style="color: rgb(4, 255, 0);"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </article>

    <main class="dash_main px-6 py-6">
        <aside class="My_themes">
            <h2>
                My Theme
            </h2>
            <a href="themes.php" class="add_theme_btn">
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
                            <h5 class="card-title text-black">Title:<?= $theme['Title'] ?></h5>
                            <form method="post" action="includes/noteAuth.php">
                                <input name="theme_id" value="<?= $theme['id'] ?>" type="hidden" />
                                <input value="View Note" name="viewNote" type="submit" />
                            </form>
                        </div>
                        <div class="buttons">
                            <form method="post" action="includes/auth.php">
                                <input name="id" value="<?= $theme['id'] ?>" type="hidden" />
                                <input value="modify" name="modify" type="submit" />
                            </form>

                            <form method="post" action="includes/auth.php">
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
            <?php if (empty($themes)): ?>

                <div class="flex justify-center">
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
                </div>

            <?php else: ?>
                <h2>My Notes</h2>
                <?php if (!empty($notes)): ?>
                    <form method="post" action="includes/noteAuth.php" class="raing">
                        <input name="theme_id" value="<?= $theme['id'] ?>" type="hidden" />
                        <input value="Top Rated" name="raingNote" type="submit" />
                    </form>
                    <div class="notes_list">
                        <?php foreach ($notes as $note): ?>

                            <div class="note">
                                <div class="note_titleDate">
                                    <h3>title:<?= $note['title'] ?></h3>
                                    <h5><?= $note['creation_date'] ?></h5>
                                </div>
                                <div class="note_buttons">
                                    <form method="POST" action="includes/noteAuth.php">
                                        <input name="note_id" value="<?= $note['id'] ?>" type="hidden" />
                                        <input value="modify" name="modify" type="submit" />
                                    </form>

                                    <form method="POST" action="includes/noteAuth.php">
                                        <input name="note_id" value="<?= $note['id'] ?>" type="hidden" />
                                        <input value="delete" name="delete" type="submit" />
                                    </form>
                                    <div class="StarRating">
                                        <?php for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $note['importance']) {
                                                echo '<span class="starRat">★</span>';
                                            } else {
                                                echo '<span class="starEmpty">★</span>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="note_content">
                                    <p><?= $note['content'] ?></p>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="flex justify-center items-center h-32 bg-gray-100 rounded-lg shadow-md">
                        <p class="text-gray-500 text-lg font-medium">No Notes present so far!</p>
                    </div>
                <?php endif; ?>
            <?php endif ?>
        </section>
    </main>


    <?php require_once "includes/footer.php" ?>
    <script src="public/dashboard.js"></script>
</body>

</html>