<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdateUserRequest;

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
        auth()->user()->fill($request->only(['name', 'email']));

        if ($request->has('password')) {
            auth()->user()->password = bcrypt($request->input('password'));
        }

        auth()->user()->save();

        session()->flash('success', 'Se han modificado los datos de tu perfil.');
        return redirect()->route('profile.edit');
    }
}
