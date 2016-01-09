<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = App\Course::all();

        factory(App\Content::class, 100)->make()->each(function ($content) use ($courses) {
            $content->course()->associate($courses->random());
            $content->save();
        });
    }
}
