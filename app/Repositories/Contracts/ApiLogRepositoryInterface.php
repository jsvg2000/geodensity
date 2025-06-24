<?php
namespace App\Repositories\Contracts;

use App\Models\ApiLog;

interface ApiLogRepositoryInterface
{
    public function store(string $username, array $countries): ApiLog;

    public function all();

    public function updateUsername(int $id, string $newUsername): ?ApiLog;

    public function delete(int $id): bool;
}