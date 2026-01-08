<?php
require_once __DIR__ . '/vendor/autoload.php';
use Modele\Repository\UserRepository;
use service\AuthService;
use Controller\AuthController;


class Router {
    private $routes = [];

    public function route($path, $callBack)
    {
        array_push($this->routes,$this->routes[$path] = $callBack);
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

// $router->route('/view/public/accountPending/',function(){
//     header("location: ");
//     exit();
// });




$router->run();