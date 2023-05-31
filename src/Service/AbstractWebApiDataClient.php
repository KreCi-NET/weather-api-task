<?php

namespace App\Service;

use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class AbstractWebApiDataClient
{
    protected function getDataFromApi($url, $responseKey)
    {
        try {
            $response = file_get_contents($url);

            if ($response === false) {
                throw new HttpException(500, 'Failed to fetch temperature from API');
            }

            $data = json_decode($response, true);
 
            $arrayKeys = explode('.', $responseKey);
            foreach ($arrayKeys as $key) {
                if (isset($data[$key])) {
                    $data = $data[$key];
                }
            }

            if (is_float($data)) {
                return $data;
            }
            
            throw new HttpException(500, 'Invalid response from API');

        } catch (\Exception $e) {
            throw new HttpException(500, 'Failed to fetch temperature from API: '.$e->getMessage());
        }

        return null;
    }
}

