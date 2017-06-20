<?php
include '../vendor/autoload.php';

use \Router\Router;
Router::get('/', function () {
    echo 'Hello world!';
});
Router::dispatch();