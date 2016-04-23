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
            'email' => 'admin@example',
        ]);

        factory(App\User::class, 'teacher')->create([
            'name' => 'Teacher',
            'email' => 'teacher@example',
        ]);

        factory(App\User::class, 'student')->create([
            'name' => 'Student',
            'email' => 'student@example',
        ]);

        factory(App\User::class, 50)->create();
    }
}
