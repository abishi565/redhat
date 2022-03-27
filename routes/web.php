<?php

use App\Actions\Yahoo\GetPageTitle\GetPageTitle;
use Illuminate\Support\Facades\Route;

Route::get('/test', function(){
    GetPageTitle::run();
});

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');


