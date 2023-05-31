<?php

namespace App\Service;

use App\Traits\ApiKeyTrait;

class WeatherApiComProvider extends AbstractWebApiDataClient implements WeatherProviderInterface
{
    use ApiKeyTrait;

    public function __construct()
    {
        $this->setApiKeyName("WEATHERAPICOM_API_KEY");
    }

    public function getTemperature($city, $country)
    {
        $url = 'http://api.weatherapi.com/v1/current.json?key='
            . $this->getApiKey()
            . '&q=' . urlencode($city). ',' . urlencode($country);
        
        return $this->getDataFromApi($url, 'current.temp_c');
    }

}
