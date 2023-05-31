<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\WeatherFormType;
use App\Service\WeatherService;
use App\Repository\WeatherResultRepository;

class WeatherController extends AbstractController
{
    private $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }
    
    public function index(Request $request, WeatherResultRepository $weatherResultRepository): Response
    {
        $form = $this->createForm(WeatherFormType::class);
        $form->handleRequest($request);

        $temperature = null;
        $error = null;  

        if ($form->isSubmitted() && $form->isValid()) {
            $city = $form->getData()->getCity();
            $country = $form->getData()->getCountry();

            try {
                $temperature = $this->weatherService->calculateAverageTemperature($city, $country);
            } catch (\Exception $exception) {
                $error = $exception->getMessage();
            }
        }

        return $this->render('weather/index.html.twig', [
            'form' => $form->createView(),
            'temperature' => $temperature,
            'error' => $error,
            'lastFiveResults' => $weatherResultRepository->findLastTemperatureResults("5")
        ]);
    }
}
