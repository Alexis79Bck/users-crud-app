<?php

namespace App\Interfaces;

use App\Models\UserProfile;

interface UserProfileRepositoryInterface
{
    public function getByUserId(int $userId): ?UserProfile;
    public function createOrUpdate(int $userId, array $data): UserProfile;
    public function deleteByUserId(int $userId): bool;
}
