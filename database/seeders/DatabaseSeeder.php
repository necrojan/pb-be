<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createUser('John Doe', 'john@doe.com', '09991231123');
        $this->createUser('Jane Doe', 'jane@doe.com', '09999990005');
        $this->createUser('Alicia Doe', 'alicia@doe.com', '0999777888');
    }

    private function createUser(string $name, string $email, string $phone)
    {
        $user = User::firstOrNew(['email' => $email]);

        if (!$user->exists) {
            $user->fill([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'remember_token' => Str::random(10)
            ]);
        }

        $user->save();
    }
}
