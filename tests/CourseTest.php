<?php

class CourseTest extends TestCase
{
    public function test_student_can_access_courses()
    {
        $user = factory(App\User::class, 'student')->create();
        $course = factory(App\Course::class)->create();
        $course->users()->sync([$user->id]);

        $this->actingAs($user)
            ->visit(route('course.index'))
            ->click($course->name)
            ->seeInElement('h1', $course->name);
    }

    public function test_student_cannot_access_courses_not_assigned()
    {
        $user = factory(App\User::class, 'student')->create();
        $course = factory(App\Course::class)->create();

        $this->actingAs($user)
            ->visit(route('course.index'))
            ->dontSee($course->name)
            ->get(route('course.show', $course->id))
            ->assertResponseStatus(403);
    }

    public function test_admin_can_access_courses_not_assigned()
    {
        $user = factory(App\User::class, 'admin')->create();
        $course = factory(App\Course::class)->create();

        $this->actingAs($user)
            ->visit(route('course.index'))
            ->click($course->name)
            ->seeInElement('h1', $course->name);
    }
}
