<?php
use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>'web','namespace'=> 'Web\Front\Http\Controllers'],function ($router){

    $router->get('/','FrontController');

});
