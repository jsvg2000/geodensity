<?php

namespace App\GraphQL\Queries;

use App\Services\ApiLogService;
use App\Models\ApiLog;
use GraphQL\Error\Error as GraphQLError; 
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function updateLogUsername($_root, array $args): ApiLog
    {
        $id = (int) $args['id'];
        $newUsername = $args['username'];

        try {
            $updatedLog = $this->apiLogService->updateUsername($id, $newUsername);
            return $updatedLog;
        } catch (ModelNotFoundException $e) {
            throw new GraphQLError('Log with ID ' . $id . ' not found.', null, null, null, null, $e);
        } catch (\Exception $e) {
            throw new GraphQLError('Error updating log username: ' . $e->getMessage(), null, null, null, null, $e);
        }
    }
    
    public function deleteLog($_root, array $args): bool
    {
        $id = (int) $args['id'];

        try {
            return $this->apiLogService->delete($id);
        } catch (ModelNotFoundException $e) {
            throw new GraphQLError('Log with ID ' . $id . ' not found for deletion.', null, null, null, null, $e);
        } catch (\Exception $e) {
            throw new GraphQLError('Error deleting log: ' . $e->getMessage(), null, null, null, null, $e);
        }
    }

    
   
}
