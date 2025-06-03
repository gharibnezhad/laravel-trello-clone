<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace'=>'Web\Board\Http\Controllers'],function ($router){
    $router->resource('boards','BoardController');
});
