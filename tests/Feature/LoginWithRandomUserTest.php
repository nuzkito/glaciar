<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginWithRandomUserTest extends TestCase
{
    function test_a_visitor_can_login_with_a_random_user()
    {
        factory(User::class, 10)->create();

        $response = $this->post(route('login-with-random-user'));

        $response->assertRedirect(route('course.index'));

        $this->assertTrue(Auth::check());
    }

    function test_a_visitor_cannot_login_with_a_random_user_if_env_is_production()
    {
        factory(User::class, 10)->create();
        config()->set('app.env', 'production');

        $response = $this->post(route('login-with-random-user'));

        $response->assertStatus(404);

        $this->assertFalse(Auth::check());
    }
}
