<?php

namespace App\Services;

use App\Exceptions\CountryServiceException;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Http;

class CountryService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.restcountries_services.url');

        if (!$this->baseUrl) {
            throw new \RuntimeException('REST Countries API URL is not configured.');
        }
    }

     protected function fetchAllCountries(): Collection
    {
        $response = Http::get("{$this->baseUrl}/all?fields=name,population,area");

        if ($response->failed()) {
            throw new CountryServiceException('Failed to fetch countries from external API.', $response->status());
        }

        return collect($response->json());
    }

    protected function calculatePopulationDensity(array $countryData): array
    {
        $population = $countryData['population'] ?? 0;
        $area = $countryData['area'] ?? 0;

        $density = ($area > 0) ? ($population / $area) : 0;

        return [
            'name' => $countryData['name']['common'] ?? 'Unknown',
            'population' => $population,
            'area' => $area,
            'density' => $density,
        ];
    }

     public function getCountriesSortedByPopulationDensity(int $limit): array
    {
        $countries = $this->fetchAllCountries();

        $processedCountries = $countries->map(function ($country) {
            return $this->calculatePopulationDensity($country);
        });

        return $processedCountries->sortByDesc('density')
                                  ->take($limit)
                                  ->values()
                                  ->all();
    }
    
}
