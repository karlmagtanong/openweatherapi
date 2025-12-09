<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class WeatherServiceFeatureTest extends TestCase
{
    public function test_weather_feature_returns_json()
    {
        Http::fake([
            '*' => Http::response([
                'name' => 'Manila',
                'main' => ['temp' => 18],
                'weather' => [
                    ['description' => 'Cloudy']
                ]
            ])
        ]);

        $response = $this->get('/weather/Manila');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'city',
                     'temperature',
                     'weather_description',
                     'timestamp',
                     'source'
                 ]);
    }
}
