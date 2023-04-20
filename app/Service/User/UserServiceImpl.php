<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function Symfony\Component\String\u;

class UserServiceImpl implements UserService
{
    public function getUsers()
    {
        return User::all();
    }

    public function createUser(array $data)
    {
        $user = User::firstOrNew(['email' => $data['email']]);

        if (!$user->exists) {
            $user->fill([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'remember_token' => Str::random(10)
            ]);

            $user->save();

            return true;
        }

        return false;
    }

    public function updateUser(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function deleteUser(User $user): ?bool
    {
        return $user->delete();
    }

    public function getUser(User $user)
    {
        try {
            return User::findOrFail($user->id);
        } catch (NotFoundHttpException $exception) {
            return $exception;
        }
    }
}
