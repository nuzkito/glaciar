<?php

class CoursesTest extends TestCase
{
    public function test_courses_can_be_deleted()
    {
        $user = factory(App\User::class, 'admin')->create();
        $course = factory(App\Course::class)->create();
        $content = factory(App\Content::class)->make();
        $course->contents()->save($content);

        $this->actingAs($user)
            ->visit(route('admin.course.index'))
            ->press('Eliminar')
            ->seePageIs(route('admin.course.index'))
            ->see('El curso ' . $course->name . ' se ha eliminado.')
            ->dontSee('courses', $course->name);
    }
}
