<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface {
    private $User;

    public function __construct(User $User) {
        $this->User = $User;
    }

    public function find($id) {
        return $this->User->findOrFail($id);
    }

    public function create(array $data) {
        return $this->User->create($data);
    }

    public function update($id, array $data) {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }

    public function all() {
        return $this->User->all();
    }

    public function actived() {
        return $this->User->where('status', 'active')->get();
    }
}
