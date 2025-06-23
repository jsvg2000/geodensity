<?php
namespace App\GraphQL\Queries;

use App\Exceptions\CountryServiceException;
use App\Services\CountryService;
use App\Services\ApiLogService;
use GraphQL\Error\Error as GraphQLError; 


class CountryResolver
{
    protected CountryService $countryService;
    protected ApiLogService $apiLogService;

     public function __construct(CountryService $countryService, ApiLogService $apiLogService)
    {
        $this->countryService = $countryService;
        $this->apiLogService = $apiLogService;
    }

    public function topCountries($_root, array $args): array
    {
        $limit = $args['limit'];
        $username = $args['username'] ?? 'anonymous';

        try {
            $countries = $this->countryService->getCountriesSortedByPopulationDensity($limit);

            $this->apiLogService->store($username,$countries);

            return $countries;

        } catch (CountryServiceException $e) {
            throw new GraphQLError(
                'Error fetching country data: ' . $e->getMessage(),
                null,
                null,
                null,
                null,
                $e
            );
        } catch (\Exception $e) {
            throw new GraphQLError(
                'An unexpected server error occurred: ' . $e->getMessage(),
                null,
                null,
                null,
                null,
                $e
            );
        }
    }

}
