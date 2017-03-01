<?php

namespace Tests\BrowserKit;

use Tests\BrowserKitTestCase;
use App\User;

class UserProfileTest extends BrowserKitTestCase
{
    public function test_user_can_edit_profile()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->click('Perfil')
            ->see($user->name)
            ->see($user->email)
            ->dontSee($user->password)
            ->type('New Name', 'name')
            ->type('email@example.com', 'email')
            ->press('Editar perfil')
            ->see('Se han modificado los datos de tu perfil.')
            ->see('New Name')
            ->see('email@example.com');
    }

    public function test_user_can_change_password()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit(route('profile.edit'))
            ->type('My new passphrase', 'password')
            ->press('Editar perfil')
            ->see('Se han modificado los datos de tu perfil.')
            ->click('Logout')
            ->visit('/login')
            ->type($user->email, 'email')
            ->type('My new passphrase', 'password')
            ->press('Login')
            ->see('Perfil')
            ->see($user->name);
    }
}
