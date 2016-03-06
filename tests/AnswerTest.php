<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnswerTest extends TestCase
{
    public function test_student_can_create_answers()
    {
        $user = factory(App\User::class, 'student')->create();
        $course = factory(App\Course::class)->create();
        $course->users()->sync([$user->id]);
        $question = factory(App\Question::class)->make();
        $question->user_id = factory(App\User::class)->create()->id;
        $course->questions()->save($question);

        $this->actingAs($user)
            ->visit(route('question.show', $question->id))
            ->type('Respondo a la pregunta.', 'body')
            ->press('Responder')
            ->seePageIs(route('question.show', $question->id))
            ->see('La respuesta ha sido enviada.')
            ->see('Respondo a la pregunta.');
    }
}
