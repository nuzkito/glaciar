<?php

namespace Tests;

use App\User;
use App\Course;
use App\Question;

class AnswerTest extends BrowserKitTestCase
{
    public function test_student_can_create_answers()
    {
        $user = factory(User::class)->create();
        $course = factory(Course::class)->create();
        $course->users()->sync([$user->id]);
        $question = factory(Question::class)->make();
        $question->user_id = factory(User::class)->create()->id;
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
