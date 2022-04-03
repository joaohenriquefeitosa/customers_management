<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Artisan;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install');
        $user = User::factory()->create([
            'name' => 'Operacional',
            'email' => 'operacional@manager.com',
            'password' => bcrypt('manager123'),
            'email_verified_at' => now()
        ]);
        $user->assignRole('operational');

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@manager.com',
            'password' => bcrypt('manager123'),
        ]);
        $user->assignRole('admin');
    }
}
