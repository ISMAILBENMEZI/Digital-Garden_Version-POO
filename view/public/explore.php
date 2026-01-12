<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Explore - Community Garden</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .theme-card {
            transition: all 0.3s ease;
        }

        .theme-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

    <?php require_once "../includes/header.php"; ?>

    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h1 class="text-4xl font-extrabold text-green-700 tracking-tight sm:text-5xl mb-4">
                Community Garden
            </h1>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto">
                Explore digital gardens created by our community.
            </p>

            <div class="mt-8 max-w-xl mx-auto">
                <form action="" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Search..." class="w-full pl-12 pr-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm transition">
                    <div class="absolute left-4 top-3.5 text-gray-400"><i class="fas fa-search"></i></div>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <?php if (!isset($_SESSION['publicThemes']) || empty($_SESSION['publicThemes'])): ?>

            <div class="text-center py-20">
                <div class="text-6xl mb-4">🌱</div>
                <h3 class="text-xl font-medium text-gray-900">No public themes found.</h3>
            </div>

        <?php else: ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($_SESSION['publicThemes'] as $theme): ?>
                    <div class="theme-card bg-white rounded-xl overflow-hidden border border-gray-100 shadow-md flex flex-col h-full">

                        <div class="h-48 bg-gray-200 relative overflow-hidden group">
                            <?php $imgSrc = !empty($theme->image) ? $theme->image : 'https://placehold.co/600x400/e2e8f0/1e293b?text=Digital+Garden'; ?>
                            <img src="<?= $imgSrc ?>" alt="Theme Cover" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-green-700 shadow-sm">Public</div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex-1">

                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-1">
                                    <?= htmlspecialchars($theme->title ?? $theme->name) ?>
                                </h3>

                                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                    <?= htmlspecialchars($theme->description ?? "No description.") ?>
                                </p>
                            </div>

                            <div class="mt-4 flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <img src="<?= !empty($theme->author_img) ? $theme->author_img : 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png' ?>" class="w-8 h-8 rounded-full object-cover border border-gray-200">
                                    <span class="text-sm font-medium text-gray-700"><?= htmlspecialchars($theme->author_name) ?></span>
                                </div>
                                <a href="/Digital-Garden_Version-POO/theme/ViewPublicNote?id=<?= $theme->id ?>" class="text-green-600 hover:text-green-800 font-semibold text-sm flex items-center transition">
                                    Read More <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </div>

    <?php require_once "../includes/footer.php"; ?>
</body>

</html>