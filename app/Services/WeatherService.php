<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;

class WeatherService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://api.openweathermap.org/data/2.5/weather';

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
    }

    public function fetchWeather($city): array
    {
        // $citycode = $city  . ',' . $code;
        // dd($citycode);
        try {
            $response = Http::get($this->baseUrl, [
                'q' => $city,
                'appid' => $this->apiKey
            ]);

           if ($response->status() !== 200) {
                throw new \Exception("Failed to fetch weather information. HTTP status: {$response->status()}");
            }

            $json = $response->json();
            // dd($json);

            return [
                'city' => $json['name'] ?? $city,
                'temperature' => $json['main']['temp'] ?? null,
                'weather_description' => $json['weather'][0]['description'] ?? null,
                'timestamp' => now()->toDateTimeString(),
                'source' => 'external',
            ];
        } catch (Exception $e) {
            throw new Exception("Weather API error: " . $e->getMessage());
        }
    }

    public function fetchWeatherCached(string $city): array
    {
        $key = "weather_$city";

        return Cache::remember($key, now()->addMinutes(10), function () use ($city) {
            $data = $this->fetchWeather($city);
            $data['source'] = 'cache';
            return $data;
        });
    }
}
