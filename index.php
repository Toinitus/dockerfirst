<?php
require 'vendor/autoload.php';

$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', function() {
    require 'home.php';
});

// dynamic named route
$router->map( 'GET', '/users', function() {
    echo 'users';
});

$match = $router->match();

// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
