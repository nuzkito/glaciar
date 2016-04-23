<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdateUserRequest;
use App\User;

class UserProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = User::find($request->input('id'));
        $this->authorize('edit-profile', $user);

        auth()->user()->fill($request->only(['name', 'email', 'password']));
        auth()->user()->save();

        session()->flash('success', 'Se han modificado los datos de tu perfil.');
        return redirect()->route('profile.edit');
    }
}
