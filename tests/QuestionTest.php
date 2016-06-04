<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuestionTest extends TestCase
{
    public function test_student_can_create_a_question()
    {
        $user = factory(App\User::class)->create();
        $course = factory(App\Course::class)->create();
        $course->users()->sync([$user->id]);

        $this->actingAs($user)
            ->visit(route('question.index', $course->id))
            ->type('¿Funcionan las preguntas?', 'title')
            ->type('Compruebo que puedo enviar preguntas.', 'body')
            ->press('Preguntar')
            ->see('La pregunta ha sido enviada')
            ->see('¿Funcionan las preguntas?')
            ->see('Compruebo que puedo enviar preguntas.');
    }

    public function test_student_can_see_questions()
    {
        $user = factory(App\User::class)->create();
        $course = factory(App\Course::class)->create();
        $course->users()->sync([$user->id]);
        $question = factory(App\Question::class)->make();
        $question->user_id = factory(App\User::class)->create()->id;
        $course->questions()->save($question);

        $this->actingAs($user)
            ->visit(route('question.index', $course->id))
            ->click($question->title)
            ->seePageIs(route('question.show', $question->id))
            ->see($question->title)
            ->see($question->body);
    }
}
