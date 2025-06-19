<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Vitor Silva',
            'email' => 'industrial.vitor.silva@gmail.com',
            'password' => Hash::make('Plastrofa.Vitor.25'),
            'role' => 'admin',
        ]);
    }
}
