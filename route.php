<?php

$routes = [];

function route($path , $callBack){
    global $routes;
    $routes[$path] = $callBack;
}


route('/' , function(){
    echo 'home';
});

route('/login' , function(){
    echo 'login';
});

function run(){
    global $routes;
    $url = $_SERVER['REQUEST_URI'];
    foreach($routes as $path => $callBack){
    if ($path !== $url){
        continue;
    }
    $callBack();

}
}
run();
