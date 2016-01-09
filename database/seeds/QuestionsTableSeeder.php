<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = App\Course::all();

        factory(App\Question::class, 100)->make()->each(function ($question) use ($courses) {
            $course = $courses->random();
            $question->course()->associate($course);
            $question->user()->associate($course->users->random());
            $question->save();
        });
    }
}
