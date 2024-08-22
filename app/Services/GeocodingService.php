<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GeocodingService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.yandex_geocoding.api_key'); // Берем ключ из конфига
    }

    public function getCoordinates(string $address)
    {
        $response = Http::get('https://geocode-maps.yandex.ru/1.x/', [
            'apikey' => $this->apiKey,
            'geocode' => $address,
            'format' => 'json'
        ]);

        $data = $response->json();

        if (isset($data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'])) {
            $coordinates = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
            list($longitude, $latitude) = explode(' ', $coordinates);

            return [
                'latitude' => $longitude,
                'longitude' => $latitude,
            ];
        }

        return null;
    }

    public function cacheCoordinates(string $cacheKey, array $coordinatesArray)
    {
        Cache::put($cacheKey, $coordinatesArray, now()->addDay());
    }
}
