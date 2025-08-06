<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService {
    private $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository) {
        $this->UserRepository = $UserRepository;
    }

    public function getUser($id) {
        return $this->UserRepository->find($id);
    }

    public function allUsers() {
        return $this->UserRepository->all();
    }

    public function activedUsers() {
        return $this->UserRepository->actived();
    }

    public function createUser(array $data) {
        $data['password'] = Hash::make($data['password']);
        return $this->UserRepository->create($data);
    }


    public function updateUser($id, array $data) {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->UserRepository->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->UserRepository->delete($id);
    }
}
