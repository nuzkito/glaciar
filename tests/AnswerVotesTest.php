<?php

namespace Tests;

use App\User;
use App\Course;
use App\Answer;
use App\Question;

class AnswerVotesTest extends BrowserKitTestCase
{
    protected function createData()
    {
        $user = factory(User::class)->create();
        $course = factory(Course::class)->create();
        $course->users()->sync([$user->id]);
        $question = factory(Question::class)->make();
        $question->user_id = factory(User::class)->create()->id;
        $course->questions()->save($question);
        $answer = factory(Answer::class)->make();
        $answer->user_id = factory(User::class)->create()->id;
        $answer->question_id = $question->id;
        $answer->save();

        return compact('user', 'course', 'question', 'answer');
    }

    public function test_user_can_vote_answers()
    {
        extract($this->createData());

        $this->actingAs($user)
            ->visit(route('question.show', $question->id))
            ->see('0 votos')
            ->press('Votar')
            ->seePageIs(route('question.show', $question->id))
            ->see('1 voto');
    }

    public function test_user_can_delete_votes()
    {
        extract($this->createData());
        $answer->votes()->attach($user->id);

        $this->actingAs($user)
            ->visit(route('question.show', $question->id))
            ->see('1 voto')
            ->press('Eliminar voto')
            ->seePageIs(route('question.show', $question->id))
            ->see('0 votos');
    }
}
