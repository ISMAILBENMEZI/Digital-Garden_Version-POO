<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use Controller\AuthController;
use Controller\themeController;

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

$router->route('/Digital-Garden_Version-POO/register', function () {
    $auth = new AuthController();
    $auth->register();
});


$router->route('/Digital-Garden_Version-POO/', function () {
    header('Location: home.php');
    exit;
});

$router->route('/Digital-Garden_Version-POO/addtheme', function () {
    $authTheme = new themeController();
    $authTheme->addOrUpdateTheme();
    header("Location: /Digital-Garden_Version-POO/UserDashboard");
    exit;
});

$router->route('/Digital-Garden_Version-POO/theme/modifyTheme', function () {
    $authTheme = new themeController();
    $authTheme->findThemeByid($_POST['id']);
    header('Location: view/public/theme.php');
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
    $themes = $themeController->affichaeTheme(); 
});


$router->run();
