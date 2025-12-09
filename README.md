# openweatherapi
Fetch of Weather API

## Requirements
- PHP 8.2
- Laravel 12
- Composer
- OpenWeatherMap API Key (included in env.example)

## Installation
1. Clone Project
2. Run Composer Install
3. Start Server in terminal: 
    - php artisan serve

## Endpoints
## GET /weather/{city}
Fetch real-time weather from OpenWeatherMap.
Returns:
- city
- temperature
- weather_description
- timestamp
- source = external

### GET /weather/{city}/cached
Fetch weather but cache result for 10 minutes.
If served from cache:
- source = cache

## Testing
Created Unit Test and Feature Test

Run all tests:
php artisan test

## Explanation for my approach

## Folder Structure

app 
    - Services/WeatherService.php
    - Http/Controllers/WeatherController.php

routes
    - web.php

tests
    -Feature/WeatherServiceFeatureTest.php
    -Unit/WeatherServiceTest.php

## Explanation

1. Create a dedicated class for the 2 endpoints that will hold the the payload and response that needed for the API fetch.
2. I used Laravel's Http Client for External API Integration
3. For the cached endpoint, I used "Cache::remember" for 10 min storage.
4. Place error handling statuses whenever API request failed or succeeded.
5. Created test for unit and feature for better structuring of the code.

