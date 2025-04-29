<?php

namespace App\Services;

use App\Interfaces\UserProfileRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\UserProfile;

class UserProfileService
{
    private $userProfileRepository;

    public function __construct(UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

     public function getUserProfile(int $userId)
    {
        return $this->userProfileRepository->getByUserId($userId);
    }

    public function updateUserProfile(int $userId, array $data): UserProfile
    {
        $validator = Validator::make($data, [
            'fullname'     => ['nullable', 'string', 'max:100'],
            'about'        => ['nullable', 'string'],
            'birthdate'    => ['nullable', 'date'],
            'gender'       => ['nullable', Rule::in(['Hombre', 'Mujer', 'No Decirlo'])],
            'country_id'   => ['nullable', 'exists:countries,id'],
            'avatar'       => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $this->userProfileRepository->createOrUpdate($userId, $data);
    }

    public function deleteUserProfile(int $userId): bool
    {
        return $this->userProfileRepository->deleteByUserId($userId);
    }
}