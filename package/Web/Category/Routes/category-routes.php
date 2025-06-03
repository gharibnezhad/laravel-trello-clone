<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Web\Category\Http\Controllers',
    "middleware"=>['web','auth','verified']],function ($router){
    $router->resource('categories','CategoryController');
});
