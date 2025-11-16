<?php
use Illuminate\Support\Facades\Route;


Route::group(["namespace"=> 'Web\Front\Http\Controllers','middleware'=>'web'],function ($router){

    $router->get('/','FrontController@index');
//    $router->redirect('/','/home');
    $router->get('/singleBoard/{id}','FrontController@singleBoard')->name('singleBoard');

});
