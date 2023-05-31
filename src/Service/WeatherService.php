<?php

namespace App\Service;

use App\Repository\WeatherResultRepository;
use App\Entity\WeatherResult;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class WeatherService
{
    private $weatherProviders;
    private $weatherResultRepository;
    private TagAwareCacheInterface $weatherCache;

    public function __construct(TagAwareCacheInterface $weatherCache, WeatherResultRepository $weatherResultRepository, WeatherProviderInterface ...$weatherProviders)
    {
        $this->weatherProviders = $weatherProviders;
        $this->weatherResultRepository = $weatherResultRepository;
        $this->weatherCache = $weatherCache;
    }

    public function calculateAverageTemperature($city, $country)
    {
        $averageTemperature = $this->weatherCache->get("$city-$country",
            function (ItemInterface $item) use ($city, $country) {
                $temperatures = [];
                try {
                    foreach ($this->weatherProviders as $weatherProvider) {
                        $temperature = $weatherProvider->getTemperature($city, $country);
                        $temperatures[] = $temperature;
                    }
                } catch (\Exception $exception) {
                    throw new HttpException(500, $exception->getMessage(), $exception);
                }
                $item->expiresAfter(180);
                return array_sum($temperatures) / count($temperatures);
            });

        $weatherResult = new WeatherResult();
        $weatherResult->setCheckTime(new \DateTime());
        $weatherResult->setCountry($country);
        $weatherResult->setCity($city);
        $weatherResult->setAverageTemperature($averageTemperature);
        $this->weatherResultRepository->add($weatherResult, true);

        return $averageTemperature;
    }
}
