<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

use Controller\adminController;
use Controller\AuthController;
use Controller\themeController;
use Controller\noteController;
use Controller\ReportController;

class Router
{
    private $routes = [];

    public function route($path, $callBack)
    {
        array_push($this->routes, $this->routes[$path] = $callBack);
    }

    public function getRoutes()
    {
        return $this->routes;
    }


    public function run()
    {
        $routes = $this->getRoutes();
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (array_key_exists($url, $routes)) {
            $callBack = $routes[$url];
            $callBack();
        } else {
            http_response_code(404);
            echo "404 - Page Not Found for path: " . htmlspecialchars($url);
        }
    }
}
$router = new Router();


// ------------------------------------------------------------//
$router->route('/Digital-Garden_Version-POO/register', function () {
    $auth = new AuthController();
    $auth->register();
});


$router->route('/Digital-Garden_Version-POO/', function () {
    header('Location: home.php');
    exit;
});

// -------------------------------------------------------------//

$router->route('/Digital-Garden_Version-POO/addOrUpdatetheme', function () {
    $authTheme = new themeController();
    $authTheme->addOrUpdateTheme();
    header("Location: /Digital-Garden_Version-POO/UserDashboard");
    exit;
});

$router->route('/Digital-Garden_Version-POO/theme/modifyTheme', function () {
    $authTheme = new themeController();
    $authTheme->findThemeByid();
    header('Location:  /Digital-Garden_Version-POO/view/public/theme.php');
    exit;
});

$router->route('/Digital-Garden_Version-POO/theme/deleteTheme', function () {
    $authTheme = new themeController();
    $authTheme->deleteThemeById();
    header("Location: /Digital-Garden_Version-POO/UserDashboard");
    exit;
});

$router->route('/Digital-Garden_Version-POO/UserDashboard', function () {
    $themeController = new themeController();
    $_SESSION['themes'] = $themeController->affichaeTheme();
    header("Location: /Digital-Garden_Version-POO/view/public/UserDashboard.php");
    exit;
});
// --------------------------------------------------------------//
$router->route('/Digital-Garden_Version-POO/login', function () {
    $auth = new AuthController();
    $loginResult = $auth->Login();
    switch ($loginResult) {
        case "pending":
            header('Location: /Digital-Garden_Version-POO/view/public/accountPending.php');
            break;
        case "blocked":
            header('Location: /Digital-Garden_Version-POO/view/public/accountBlock.php');
            break;
        case "user":
            header('Location: /Digital-Garden_Version-POO/view/public/userDashboard.php');
            break;
        case "admin":
            $adminController = new adminController();
            $adminController->getAllUsers();
            $reportController = new ReportController();
            $reportController->getAllReports();
            header('Location: /Digital-Garden_Version-POO/view/public/dashboard.php');
            break;
        case "Moderator":
            header('Location: /Digital-Garden_Version-POO/view/public/accountModrator.php');
            break;
        default:
            header('Location: /Digital-Garden_Version-POO/view/public/login.php');
            break;
    }
});
// --------------------------------------------------------------//

$router->route('/Digital-Garden_Version-POO/theme/ViewNote', function () {
    $noteController = new noteController();
    $_SESSION['note'] = $noteController->affichaeNote();
    header("Location: /Digital-Garden_Version-POO/UserDashboard");
    exit;
});

$router->route('/Digital-Garden_Version-POO/addOrUpdatenote', function () {
    $authNote = new noteController();
    $authNote->addOrUpdateNote();
    header("Location: /Digital-Garden_Version-POO/UserDashboard");
    exit;
});

$router->route('/Digital-Garden_Version-POO/UserDashboard/modifyNote', function () {
    $authNote = new noteController();
    $authNote->findNoteByid();
    header('Location: /Digital-Garden_Version-POO/view/public/note.php');
    exit;
});

$router->route('/Digital-Garden_Version-POO/UserDashboard/deleteNote', function () {
    $authNote = new noteController();
    $authNote->deleteNoteById();
    header("Location: /Digital-Garden_Version-POO/UserDashboard");
    exit;
});

$router->route('/Digital-Garden_Version-POO/UserDashboard/raingNote', function () {
    $authNote = new noteController();
    $_SESSION['note'] = $authNote->ratingNote();
    header("Location: /Digital-Garden_Version-POO/UserDashboard");
    exit;
});
// ---------------------------------------------------------//
$router->route('/Digital-Garden_Version-POO/explore', function () {
    $authTheme = new themeController();
    $authTheme->publicThemes();
    header('Location: /Digital-Garden_Version-POO/view/public/explore.php');
    exit;
});
// ----------------------------------------------------------//
$router->route('/Digital-Garden_Version-POO/dashboard/UpdateStatut', function () {
    $adminController = new adminController();
    $adminController->updateStaut();
    $adminController->getAllUsers();
    header('Location: /Digital-Garden_Version-POO/view/public/dashboard.php');
    exit;
});
$router->route('/Digital-Garden_Version-POO/dashboard/UpdateRepor', function () {
    $reportController = new ReportController();
    $reportController->updateReport();
    $reportController->getAllReports();
    header('Location: /Digital-Garden_Version-POO/view/public/dashboard.php');
    exit;
});

// ----------------------------------------------------------//
$router->run();
