<?php
include '../vendor/autoload.php';

use \Router\Route;

Route::get('/', function () {
    echo 'Hello world!';
});

Route::get('/posts/{cate}/{name}', function ($cate, $name) {
    echo $cate, '---', $name;
});

Route::get('/test', 'controllers\Test@index');

Route::get('/test/{abc}', 'controllers\Test@demo');

Route::dispatch();