<div class="m-auto max-w-md bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 p-6 rounded-xl space-y-6">

    <!-- Weather Search -->
    <form wire:submit="fetchWeatherData" class="flex items-center space-x-4">
        <flux:input type="text" wire:model="location" placeholder="Search for a city..." />
        <flux:button type="submit" variant="primary">Search</flux:button>
    </form>

    <div>
        <flux:text wire:text="error" variant="strong" color="red"></flux:text>
    </div>

    @if ($currentWeather)
        <div>
            <flux:heading size="lg">{{ $currentWeather['name'] }}</flux:heading>
            <div class="flex items-center justify-between">
                <div>
                    <flux:text>{{ $currentWeather['dt_formatted'] }}</flux:text>
                    <flux:text class="my-4">
                        <span class="text-5xl font-bold">{{ $currentWeather['main']['temp'] }}</span>°C
                    </flux:text>
                    <flux:text>{{ $currentWeather['weather'][0]['description'] }}</flux:text>
                    <flux:text>Feels like {{ $currentWeather['main']['feels_like'] }}</flux:text>
                </div>
                <div>
                    <img src="{{ $currentWeather['weather'][0]['icon'] }}" alt="Weather icon">
                </div>
            </div>
        </div>
    @else
        <flux:text>Please enter a city to get the weather data.</flux:text>
    @endif

    <div class="flex items-center justify-between">
        <flux:switch x-data x-model="$flux.dark" label="Dark mode" class="space-y-4" />
    </div>
</div>