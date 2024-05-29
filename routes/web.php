<?php

use Illuminate\Support\Facades\Route;


Route::get('/t2', function () {
    return 'hello world';
});


Route::get('/', function () {
    return view('welcome');
});
