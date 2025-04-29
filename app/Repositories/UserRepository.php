<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function getAllWithProfile(int $perPage = 10): LengthAwarePaginator
    {
        return User::with('profile')->paginate($perPage);
    }

    public function getById(int $id): ?User
    {
        return User::findOrFail($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return User::findOrFail($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return User::findOrFail($id)->delete();
    }
}