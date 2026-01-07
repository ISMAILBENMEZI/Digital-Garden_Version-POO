<?php
require_once "Modele/Repository/UserRepository.php";
require_once "service/AuthService.php";
require_once "Controller/authController.php";
require_once __DIR__ . '/vendor/autoload.php';

$routes = [];

function route($path, $callBack)
{
    global $routes;
    $routes[$path] = $callBack;
}

route('/Digital-Garden_Version-POO/register', function () {
    $userRepo = new UserRepository();
    $service = new AuthService($userRepo);
    $auth = new AuthController($service);
    $auth->register();
});

route('/Digital-Garden_Version-POO/', function () {
    header('Location: home.php');
    exit;
});

function run()
{
    global $routes;

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (array_key_exists($url, $routes)) {
        $callBack = $routes[$url];
        $callBack();
    } else {
        http_response_code(404);
        echo "404 - Page Not Found for path: " . htmlspecialchars($url);
    }
}
run();
