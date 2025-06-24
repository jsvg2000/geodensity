<?php
namespace App\Services;

use App\Models\ApiLog;
use App\Repositories\Contracts\ApiLogRepositoryInterface;

class ApiLogService
{
    public function __construct(protected ApiLogRepositoryInterface $apiLogRepository) {}

    public function store(string $username, array $countries): ApiLog
    {
        return $this->apiLogRepository->store($username, $countries);
    }

    public function allLogs()
    {
        return $this->apiLogRepository->all();
    }

    public function updateUsername(int $id, string $newUsername): ?ApiLog
    {
        return $this->apiLogRepository->updateUsername($id, $newUsername);
    }

    public function delete(int $id): bool
    {
        return $this->apiLogRepository->delete($id);
    }
}