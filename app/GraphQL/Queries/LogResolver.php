<?php

namespace App\GraphQL\Queries;

use App\Services\ApiLogService;
use GraphQL\Error\Error as GraphQLError; 
use Carbon\Carbon; 

class LogResolver
{
    protected ApiLogService $apiLogService;

    public function __construct(ApiLogService $apiLogService)
    {
        $this->apiLogService = $apiLogService;
    }

    public function getLogs($_root, array $args)
    {
        try {
            $query = $this->apiLogService->allLogs();

            if (isset($args['startDate'])) {
                $startDate = Carbon::parse($args['startDate'])->startOfDay();
                $query->where('request_timestamp', '>=', $startDate);
            }

            if (isset($args['endDate'])) {
                $endDate = Carbon::parse($args['endDate'])->endOfDay();
                $query->where('request_timestamp', '<=', $endDate);
            }


            $query->orderByDesc('request_timestamp');

            return $query->get();

        } catch (\Exception $e) {
            throw new GraphQLError('Error fetching logs: ' . $e->getMessage(), null, null, null, null, $e);
        }
    }
    
   
}
