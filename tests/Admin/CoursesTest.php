<?php

namespace Tests\Admin;

use Tests\BrowserKitTestCase;
use App\User;
use App\Course;
use App\Content;

class CoursesTest extends BrowserKitTestCase
{
    public function test_courses_can_be_deleted()
    {
        $user = factory(User::class, 'admin')->create();
        $course = factory(Course::class)->create();

        $this->actingAs($user)
            ->visit(route('admin.course.index'))
            ->press('Eliminar')
            ->seePageIs(route('admin.course.index'))
            ->see('El curso ' . $course->name . ' se ha eliminado.')
            ->dontSee('courses', $course->name);
    }
}
