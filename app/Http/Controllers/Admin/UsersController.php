<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
            'role' => 'in:student,professor,admin',
        ]);

        $user = new User($request->only(['name', 'email', 'role']));
        $user->password = bcrypt($request->input('password'));
        $user->save();

        session()->flash('success', 'El usuario se ha creado.');
        return redirect()->route('admin.user.edit', $user->id);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => '',
            'role' => 'in:student,professor,admin',
        ]);

        $user = User::find($id);
        $user->fill($request->only(['name', 'email', 'role']));
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        session()->flash('success', 'Los datos del usuario se han actualizado.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('success', 'El usuario ' . $user->name . ' se ha eliminado.');
        return redirect()->route('admin.user.index');
    }
}
