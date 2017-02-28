<?php

namespace Tests;

use App\User;
use App\Course;

class CourseTest extends BrowserKitTestCase
{
    public function test_student_can_access_courses()
    {
        $user = factory(User::class)->create();
        $course = factory(Course::class)->create();
        $course->users()->sync([$user->id]);

        $this->actingAs($user)
            ->visit(route('course.index'))
            ->click($course->name)
            ->seeInElement('h1', $course->name);
    }

    public function test_student_cannot_access_courses_not_assigned()
    {
        $user = factory(User::class)->create();
        $course = factory(Course::class)->create();

        $this->actingAs($user)
            ->visit(route('course.index'))
            ->dontSee($course->name)
            ->get(route('course.show', $course->id))
            ->assertResponseStatus(403);
    }

    public function test_admin_can_access_courses_not_assigned()
    {
        $user = factory(User::class, 'admin')->create();
        $course = factory(Course::class)->create();

        $this->actingAs($user)
            ->visit(route('course.index'))
            ->click($course->name)
            ->seeInElement('h1', $course->name);
    }

    public function test_teacher_can_access_course()
    {
        $user = factory(User::class)->create();
        $course = factory(Course::class)->create();
        $course->teachers()->sync([$user->id]);

        $this->actingAs($user)
            ->visit(route('course.index'))
            ->click($course->name)
            ->seeInElement('h1', $course->name);
    }
}
