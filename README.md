# Weather App

A modern weather application built with Laravel, Livewire, and Vite. This app fetches and displays weather data using the OpenWeather API, providing a responsive and interactive user experience.

## Installation

1. **Clone the repository:**
   ```zsh
   git clone https://github.com/yourusername/weather-app.git
   cd weather-app
   ```

2. **Install PHP dependencies:**
   ```zsh
   composer install
   ```

3. **Install npm dependencies:**
   ```zsh
   npm install
   ```

4. **Set up environment variables:**
   - Copy the `.env.example` file to `.env` and update the `OPENWEATHER_API_KEY` with your OpenWeather API key.
   ```zsh
   cp .env.example .env
   ```

5. **Run the application:**
   ```zsh
   composer run dev
   ```

## Project Structure

- `app/` - Application logic (Controllers, Livewire components, Models, Services)
- `resources/views/` - Blade templates and Livewire views
- `routes/` - Route definitions
- `public/` - Public assets and entry point
- `tests/` - Feature and unit tests
