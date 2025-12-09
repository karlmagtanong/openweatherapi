<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Services\WeatherService;

class WeatherServiceTest extends TestCase
{
    public function test_fetch_weather_structure()
    {
        // Fake HTTP responses
        Http::fake([
            '*' => Http::response([
                'name' => 'Manila',
                'main' => ['temp' => 30],
                'weather' => [['description' => 'sunny']],
            ], 200)
        ]);

        $service = new WeatherService();
        $data = $service->fetchWeather('Manila');

        // dd($data);

        $this->assertArrayHasKey('city', $data);
        $this->assertArrayHasKey('temperature', $data);
        $this->assertArrayHasKey('weather_description', $data);
        $this->assertArrayHasKey('timestamp', $data);
        $this->assertArrayHasKey('source', $data);
    }
}
