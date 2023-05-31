<?php

namespace App\Service;

interface WeatherProviderInterface
{
    public function getTemperature($city, $country);
}