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
        $courses = factory(App\Course::class, 5)->create();
        $courses->each(function ($course) {
            $course->contents()
                ->saveMany(factory(App\Content::class, mt_rand(1, 10))->make());
        });

        $users = App\User::all();
        foreach ($users as $user) {
            foreach ($courses as $course) {
                if (0 === mt_rand(0, 2)) {
                    $user->courses()->attach($course);
                }
            }
        }
    }
}
