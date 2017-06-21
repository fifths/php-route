<?php
include '../vendor/autoload.php';

use \Router\Route;

Route::get('/', function () {
    echo 'Hello world!';
});

Route::get('/posts/{cate}/{name}', function ($cate,$name) {
    //var_dump($cate);
    var_dump($cate);
    var_dump($name);
});


Route::dispatch();