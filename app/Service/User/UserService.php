<?php

namespace App\Service\User;

use App\Models\User;

interface UserService
{
    public function getUsers();

    public function createUser(array $data);

    public function getUser(User $user);

    public function updateUser(User $user, array $data);

    public function deleteUser(User $user);
}
