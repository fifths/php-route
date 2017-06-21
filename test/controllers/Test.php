<?php

/**
"classmap": [
"test/controllers"
]
 */
namespace controllers;

class Test
{
    public function index()
    {
        echo 'index';
    }

    public function demo($abc)
    {
        echo $abc;
    }
}