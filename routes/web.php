<?php

use App\Http\Controllers\API\V1\UrlRedirectController;
use App\Http\Controllers\API\V2\UrlRedirectController as UrlRedirectController2;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/{shortened_url}', [UrlRedirectController::class, 'redirectToOriginal']);
Route::get('/{shortened_url}/V2', [UrlRedirectController2::class, 'redirectToOriginal']);