<?php

use App\Livewire\Weather;
use Illuminate\Support\Facades\Route;

Route::get('/weather', Weather::class)->name('weather');

require __DIR__.'/auth.php';
