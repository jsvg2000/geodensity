<?php

namespace App\Services;

use App\Models\ApiLog;
use Illuminate\Support\Facades\Log;

class ApiLogService
{
    public function store(string $username, array $countries): ApiLog
    {

        return ApiLog::create([
            'username' => $username,
            'num_countries_returned' => count($countries),
            'countries_details' => json_encode($countries),
        ]);
    }

    public function allLogs()
    {
        return  ApiLog::query();
    }

    public function updateUsername(int $id, string $newUsername): ?ApiLog
    {
        $apiLog = ApiLog::find($id);

        if ($apiLog) {
            $apiLog->username = $newUsername;
            $apiLog->save();
            return $apiLog;
        }

        return null;
    }

    public function delete(int $id): bool
    {
        $apiLog = ApiLog::find($id);

        if ($apiLog) {
            $result = $apiLog->delete();

            return $result !== null ? $result : false;
        }

        return false; 
    }



}
