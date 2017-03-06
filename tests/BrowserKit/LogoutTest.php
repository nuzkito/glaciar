<?php

namespace Tests\BrowserKit;

use Tests\BrowserKitTestCase;
use App\User;
use Illuminate\Support\Facades\Auth;

class LogoutTest extends BrowserKitTestCase
{
    function test_user_can_logout()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->press('Cerrar sesión')
            ->seeRouteIs('login')
            ->dontSeeIsAuthenticated();
    }
}
