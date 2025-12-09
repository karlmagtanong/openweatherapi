<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/weather/{city}', [WeatherController::class, 'getWeather']);
Route::get('/weather/{city}/cached', [WeatherController::class, 'getWeatherCached']);

// Route::get('/', function () {
//     return view('welcome');
// });
