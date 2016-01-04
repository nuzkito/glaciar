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

        return redirect('/admin/usuarios');
    }
}
