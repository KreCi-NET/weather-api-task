<?php

namespace App\Service;

use App\Traits\ApiKeyTrait;

class OpenWeatherMapProvider extends AbstractWebApiDataClient implements WeatherProviderInterface
{
    use ApiKeyTrait;

    public function __construct()
    {
        $this->setApiKeyName("OPEN_WEATHER_MAP_API_KEY");
    }

    public function getTemperature($city, $country)
    {
        $url = 'https://api.openweathermap.org/data/2.5/weather?q='
            . urlencode($city) . ',' . urlencode($country)
            . '&appid=' . $this->getApiKey()
            . '&units=metric';

        return $this->getDataFromApi($url, 'main.temp');
    }
}
