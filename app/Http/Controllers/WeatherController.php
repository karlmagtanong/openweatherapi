<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
     public function getWeather(string $city, WeatherService $service): JsonResponse
    {
        try {
            return response()->json($service->fetchWeather($city));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getWeatherCached(string $city, WeatherService $service): JsonResponse
    {
        try {
            return response()->json($service->fetchWeatherCached($city));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
