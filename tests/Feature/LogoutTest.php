<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Auth;

class LogoutTest extends TestCase
{
    function test_user_can_logout()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));

        $this->assertFalse(Auth::check());
    }

    function test_user_cannot_logout_with_a_get_request()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('logout'));

        $response->assertStatus(405);

        $this->assertTrue(Auth::check());
    }
}
