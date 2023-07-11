<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Services\WeatherService;

class Forecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast {location}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets a 5 day weather forecast';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get 5 day weather forecast
        $this->comment(var_dump(WeatherService::getForecast($this->argument('location'))));

    }

}

