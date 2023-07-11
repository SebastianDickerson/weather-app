<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService 
{

    const BASE_URL = "api.openweathermap.org/data/2.5/";

    static function getForecast ( string $location )
    {

        $apiKey = config('app.openweather_api'); 
        $response = Http::get(self::BASE_URL."forecast?q={$location}&appid={$apiKey}");

        return self::parseResponse( $response );

    }

    static function parseResponse ( mixed $data ) 
    {

        $obj['city'] = $data->json($key='city')['name'];

        return $obj;
    }

}
