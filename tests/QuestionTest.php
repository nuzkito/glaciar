<?php

namespace Tests;

use App\User;
use App\Course;
use App\Question;

class QuestionTest extends BrowserKitTestCase
{
    public function test_student_can_create_a_question()
    {
        $user = factory(User::class)->create();
        $course = factory(Course::class)->create();
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
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $question->course->users()->sync([$user->id]);

        $this->actingAs($user)
            ->visit(route('question.index', $question->course->id))
            ->click($question->title)
            ->seePageIs(route('question.show', $question->id))
            ->see($question->title)
            ->see($question->body);
    }
}
