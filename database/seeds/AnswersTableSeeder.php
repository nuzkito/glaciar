<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = App\Question::all();

        factory(App\Answer::class, 400)->make()->each(function ($answer) use ($questions) {
            $question = $questions->random();
            $answer->question()->associate($question);
            $answer->user()->associate($question->course->users->random());
            $answer->save();
        });
    }
}
