<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();

        factory(App\Course::class, 10)->create()->each(function ($course) use ($users) {
            $course->users()->sync($users->random(mt_rand(2, $users->count())));
            $course->teachers()->sync($users->random(3));
        });
    }
}
