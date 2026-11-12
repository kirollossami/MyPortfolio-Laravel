<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    protected $signature = 'admin:create
                            {--name= : Admin display name}
                            {--email= : Admin login email}
                            {--password= : Admin login password (min 8 characters)}';

    protected $description = 'Create a new admin user for the Portfolio MVC Dashboard';

    public function handle(): int
    {
        $name = $this->option('name') ?: $this->ask('Admin name');
        $email = strtolower(trim((string) ($this->option('email') ?: $this->ask('Admin email'))));
        $password = $this->option('password') ?: $this->secret('Admin password (min 8 characters)');

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info("Admin user [{$user->email}] created successfully.");

        return self::SUCCESS;
    }
}

