<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Reynaldi Lusikooy',
            'email' => 'reinskywalker@admin.com',
            'password' => bcrypt('superadmin'),
        ]);
        $user->assignRole('user', 'admin', 'super-admin');
    }
}
