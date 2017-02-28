<?php

namespace Tests;

use App\User;
use App\Course;
use App\Question;

class QuestionVotesTest extends BrowserKitTestCase
{
    protected function createData()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $course = $question->course;
        $course->users()->sync([$user->id]);

        return compact('user', 'course', 'question');
    }

    public function test_user_can_vote_questions()
    {
        extract($this->createData());

        $this->actingAs($user)
            ->visit(route('question.index', $course->id))
            ->see('0 votos')
            ->press('Votar')
            ->seePageIs(route('question.index', $course->id))
            ->see('1 voto');
    }

    public function test_user_can_delete_votes()
    {
        extract($this->createData());
        $question->votes()->attach($user->id);

        $this->actingAs($user)
            ->visit(route('question.index', $course->id))
            ->see('1 voto')
            ->press('Eliminar voto')
            ->seePageIs(route('question.index', $course->id))
            ->see('0 votos');
    }
}
