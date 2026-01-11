<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

use Controller\AuthController;
use Controller\themeController;
use Controller\noteController;

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

// ----------------------------------------------------------//
$router->run();
