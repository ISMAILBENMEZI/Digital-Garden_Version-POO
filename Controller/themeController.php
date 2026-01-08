<?php

namespace Controller;

use Modele\Entity\Theme;
use Modele\Repository\themeRepository;
use service\themeService;
use PDO;

class themeController
{
    private themeService $themeService;

    public function __construct()
    {
        $this->themeService = new themeService();
    }

    function affichaeTheme()
    {
        if (isset($_SESSION['user']) && is_object($_SESSION['user'])) {
            $user_id = $_SESSION['user']->getId();
        } else {
            $_SESSION['error'] = "Session expired. Please login again.";
            header("Location: ../view/public/login.php");
            exit();
        }

        $theme = new Theme(
            title: null,
            color: null,
            user_id: $user_id,
            id: null
        );

        $result = $this->themeService->affichaeTheme($theme);
        return $result;
    }

    public function addOrUpdateTheme()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['addTheme']) || isset($_POST['updateTheme']))) {
            $id = !empty($_POST['id']) ? $_POST['id'] : null;
            $title = $_POST['Title'] ?? '';
            $color = $_POST['color'] ?? '';

            if (isset($_SESSION['user']) && is_object($_SESSION['user'])) {
                $user_id = $_SESSION['user']->getId();
            } else {
                $_SESSION['error'] = "Session expired. Please login again.";
                header("Location: ../view/public/login.php");
                exit();
            }

            if (empty($title) || empty($color)) {
                $_SESSION['error'] = "Please fill in all experience fields";
                header("Location: ../view/public/theme.php");
                exit();
            }

            if (strlen($title) > 20) {
                $_SESSION['error'] = "Title is too long (max 20 chars).";
                header("Location: ../view/public/theme.php");
                exit();
            }

            $theme = new Theme(
                title: $title,
                color: $color,
                user_id: $user_id,
                id: $id
            );

            $result = $this->themeService->addOrUpdateTheme($theme);
            if ($result === "update") {
                unset($_SESSION['updateId'], $_SESSION['updateTitle'], $_SESSION['updateColor'], $_SESSION['Update']);
                $_SESSION['success'] = "Theme updated successfully";
            } elseif ($result === "add") {
                $_SESSION['success'] = 'Theme created successfully';
            } else {
                $_SESSION['error'] = 'error. Please try again later.';
            }
        }
    }

    public function deleteThemeById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
            $id = $_POST['id'];

            if (isset($_SESSION['user']) && is_object($_SESSION['user'])) {
                $user_id = $_SESSION['user']->getId();
            } else {
                $_SESSION['error'] = "Session expired. Please login again.";
                header("Location: ../view/public/login.php");
                exit();
            }

            $theme = new Theme(
                title: null,
                color: null,
                user_id: $user_id,
                id: $id
            );

            $deleteResult = $this->themeService->deleteThemeById($theme);
            if ($deleteResult) {
                $_SESSION['success'] = "Theme deleted successfully!";
            } else {
                // إذا دخل هنا، فهذا يعني أن الثيم غير موجود، أو أن المستخدم لا يملك هذا الثيم
                $_SESSION['error'] = "Could not delete theme.";
            }
        }
    }

    public function findThemeByid($id)
    {

        if (isset($_SESSION['user']) && is_object($_SESSION['user'])) {
            $user_id = $_SESSION['user']->getId();
        } else {
            $_SESSION['error'] = "Session expired. Please login again.";
            header("Location: ../view/public/login.php");
            exit();
        }

        $theme = new Theme(
            title: null,
            color: null,
            user_id: $user_id,
            id: $id
        );

        $foundTheme = $this->themeService->findThemeById($theme);
        if ($foundTheme) {
            $_SESSION['updateTitle'] = $foundTheme->name;
            $_SESSION['updateColor'] = $foundTheme->Color;
            $_SESSION['updateId'] = $foundTheme->id;
        }
        $_SESSION['error'] = "Theme not found.";
        exit();
    }
}
