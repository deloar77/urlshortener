<?php

use App\Http\Controllers\API\V1\UrlController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V2\UrlController as UrlController2;
use App\Http\Controllers\API\V2\UserController as UserController2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('V1')->group(function(){
   Route::post('/UserRegistration',[UserController::class,'UserRegistration']);
   Route::post('/UserLogin',[UserController::class,'UserLogin']);

   Route::middleware('auth:sanctum')->group(function(){
   Route::post('/shorten',[UrlController::class, 'shorten']);
   Route::post('/UserUrls',[UrlController::class,'UserUrls']);

   });
  
    
});


Route::prefix('V2')->group(function(){
   Route::post('/UserRegistration',[UserController2::class,'UserRegistration']);
   Route::post('/UserLogin',[UserController2::class,'UserLogin']);

   Route::middleware('auth:sanctum')->group(function(){
   Route::post('/shorten',[UrlController2::class, 'shorten']);
   Route::post('/UserUrls',[UrlController2::class,'UserUrls']);

   });
  
    
});