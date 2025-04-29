<?php

namespace App\Services;

use App\Enums\UserStatusOptions;
use App\Exceptions\Customs\API\ApiException;
use App\Models\User;
use App\Interfaces\UserProfileRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserService
{
    //private $userRepository;
    //private $userProfileRepository;

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserProfileRepositoryInterface $userProfileRepository
    ) {
    }

    public function createUser(array $data): User
    {
        $validator = Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_admin' => ['boolean'],
            'status' => ['required', Rule::in(UserStatusOptions::cases())],
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $field => $messages) {
                foreach ($messages as $message) {
                    $errors[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }
            throw new ApiException('Error de validación', Response::HTTP_UNPROCESSABLE_ENTITY, new ValidationException($validator));

        }

        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        return $user;
    }

    public function updateUser(int $id, array $data): bool
    {
        $validator = Validator::make($data, [
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'is_admin' => ['boolean'],
            'status' => ['required', Rule::in(UserStatusOptions::cases())],
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $field => $messages) {
                foreach ($messages as $message) {
                    $errors[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }
            throw new ApiException('Error de validación', Response::HTTP_UNPROCESSABLE_ENTITY, new ValidationException($validator));
        }
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser(int $id): bool
    {
        return $this->userRepository->delete($id);
    }

    public function getUserWithProfile(int $id): User
    {
        return $this->userRepository->getById($id);
    }

    public function getAllWithProfile(?int $perPage): LengthAwarePaginator
    {
        return $this->userRepository->getAllWithProfile($perPage);
    }
}