<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'System',
            'lastname' => 'Admin',
            'username' => 'admin',
            'email' => 'info@ecmterminals.com',
            'email_verified_at' => now(),
            'staff_id' => 1,
            'department_id' => 1,
            'category_id' => null,
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
