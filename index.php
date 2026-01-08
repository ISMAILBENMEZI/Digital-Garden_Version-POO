<?php

$routes = [];

function route($path , $callBack){
    global $routes;
    $routes[$path] = $callBack;
}



route('/Digital-Garden_Version-POO/register' , function(){
    $userRepo = new UserRepository();
    $service = new AuthService($userRepo);
    $auth = new AuthController($service);
    $auth->register();
   
});

route('/login' , function(){
    echo 'login';
});

function run(){
    global $routes;
    $url = $_SERVER['REQUEST_URI'];
    var_dump($url);
    foreach($routes as $path => $callBack){
    if ($path !== $url){
        continue;
    }
    $callBack();

}
}
run();
?>




