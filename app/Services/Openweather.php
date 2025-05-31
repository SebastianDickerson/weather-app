<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use \DateTime;
use \DateTimeZone;

class Openweather
{
    private $apiKey;
    private $baseUrl;
    private $version;

    public function __construct()
    {
        $this->apiKey = env('OPEN_WEATHER_API_KEY');
        $this->baseUrl = 'https://api.openweathermap.org/data/';
        $this->version = '2.5';

        if (!$this->apiKey) {
            Log::error('OpenWeather API key is not set in the environment.');
        }
    }

    public function getCurrentWeather(string $location = 'Brisbane')
    {
        if (Cache::has('weather_data' . $location)) {
            Log::info('Returning cached weather data for ' . $location);
            return Cache::get('weather_data' . $location);
        }

        $coordinates = $this->getLocationCoordinates($location);
        $response = Http::get($this->baseUrl . $this->version . '/weather', [
            'lat' => $coordinates['lat'],
            'lon' => $coordinates['lon'],
            'units' => 'metric',
            'appid' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['dt'])) {
                $date = new DateTime('@' . $data['dt']);
                $date->setTimezone(new DateTimeZone('Australia/Brisbane'));
                $formatted = $date->format("D, d F, H:i");
                $data['dt_formatted'] = $formatted;
            }

            if (isset($data['weather'][0]['icon'])) {
                $iconCode = $data['weather'][0]['icon'];
                $data['weather'][0]['icon'] = 'https://openweathermap.org/img/wn/' . $iconCode . '@2x.png';
            } else {
                Log::warning('Weather icon not found in the response for ' . $location);
            }

            Cache::put('weather_data' . $data['name'], $data, now()->addMinutes(5));
            Log::info('Weather data fetched successfully for ' . $data['name']);
            return $data;
        } else {
            Log::error('OpenWeather API request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return [
                'error' => 'Failed to fetch weather data. Please try again later.',
                'location' => $location,
            ];
        }
    }

    private function getLocationCoordinates($location)
    {
        $response = Http::get('https://api.openweathermap.org/geo/1.0/direct', [
            'q' => $location,
            'limit' => 1,
            'appid' => $this->apiKey,
        ]);
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data)) {
                Log::info('Coordinates fetched successfully for ' . $location);
                return [
                    'lat' => $data[0]['lat'],
                    'lon' => $data[0]['lon'],
                ];
            }
        } else {
            Log::error('OpenWeather Geo API request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }

        return [
            'lat' => 37.7749,
            'lon' => -122.4194,
        ];
    }
}
