<?php
namespace App\Repositories\Eloquent;

use App\Models\ApiLog;
use \App\Repositories\Contracts\ApiLogRepositoryInterface;

class EloquentApiLogRepository implements ApiLogRepositoryInterface
{
    public function store(string $username, array $countries): ApiLog
    {
        return ApiLog::create([
            'username' => $username,
            'num_countries_returned' => count($countries),
            'countries_details' => json_encode($countries),
        ]);
    }

    public function all()
    {
        return ApiLog::query();
    }

    public function updateUsername(int $id, string $newUsername): ?ApiLog
    {
        $apiLog = ApiLog::find($id);

        if ($apiLog) {
            $apiLog->username = $newUsername;
            $apiLog->save();
        }

        return $apiLog;
    }

    public function delete(int $id): bool
    {
        $apiLog = ApiLog::find($id);

        return $apiLog ? $apiLog->delete() : false;
    }
}