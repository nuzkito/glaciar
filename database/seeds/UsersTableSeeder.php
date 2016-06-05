<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 'admin')->create([
            'name' => 'Admin',
            'email' => 'admin@glaciar.xyz',
        ]);

        factory(App\User::class)->create([
            'name' => 'Teacher',
            'email' => 'teacher@glaciar.xyz',
        ]);

        factory(App\User::class)->create([
            'name' => 'Student',
            'email' => 'student@glaciar.xyz',
        ]);

        factory(App\User::class, 50)->create();
    }
}
