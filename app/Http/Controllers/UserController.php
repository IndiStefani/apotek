<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function indexSuper()
    {
        $users = User::all();
        return view('super.user.index', compact('users'));
    }

    public function indexUser()
    {
        $users = User::all();
        return view('user.indexUser', compact('users'));
    }

    public function create()
    {
        return view('user.createUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'usertype' => 'required',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'usertype' => $request->input('usertype'),
        ]);

        return redirect()->route('user.indexUser')->with('success', 'User telah ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('user.userEdit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'usertype' => 'required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'usertype' => $request->input('usertype'),
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        // Update data pengguna ke database
        $user->update($data);

        return redirect()->route('user.indexUser')->with('success', 'User telah diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.indexUser')->with('success', 'User telah dihapus.');
    }
}
