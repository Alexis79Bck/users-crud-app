<?php

namespace App\Repositories;
use App\Interfaces\UserProfileRepositoryInterface;
use App\Models\UserProfile;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    public function getByUserId(int $userId): ?UserProfile
    {
        return UserProfile::where('user_id', $userId)->first();
    }

    public function createOrUpdate(int $userId, array $data): UserProfile
    {
        return UserProfile::updateOrCreate(['user_id' => $userId], $data);
    }

     public function deleteByUserId(int $userId): bool
    {
        return UserProfile::where('user_id', $userId)->delete();
    }
}