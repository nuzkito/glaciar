<?php

class QuestionVotesTest extends TestCase
{
    protected function createData()
    {
        $user = factory(App\User::class)->create();
        $course = factory(App\Course::class)->create();
        $course->users()->sync([$user->id]);
        $question = factory(App\Question::class)->make();
        $question->user_id = factory(App\User::class)->create()->id;
        $course->questions()->save($question);

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
