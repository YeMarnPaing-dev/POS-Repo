<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::namespace('Api')->group(function(){
    Route::get('register',[AuthController::class,'register']);

});
