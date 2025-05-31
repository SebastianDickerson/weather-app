<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\Openweather;

class Weather extends Component
{
    public $currentWeather;
    public $location = '';
    public $error = null;
    public $locations = [
        'Brisbane',
        'Sydney',
        'Melbourne',
        'Perth',
        'Adelaide',
        'Hobart',
        'Darwin',
        'Canberra'
    ];
    public $autoCompleteLocations = [];
    

    public function fetchWeatherData(Openweather $openweatherService)
    {
        if (empty($this->location)) {
            $this->error = 'Please enter a location.';
            $this->currentWeather = null;
            return;
        } else {
            $this->error = null;
        }
        $this->currentWeather = $openweatherService->getCurrentWeather($this->location);
    }

    public function filterSearchLocations($searchTerm)
    {
        $this->autoCompleteLocations = array_filter($this->locations, function ($location) use ($searchTerm) {
            return stripos($location, $searchTerm) !== false;
        });
    }

    public function render()
    {
        return view('livewire.weather');
    }
}
