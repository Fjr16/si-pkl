<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();

        return view('user.index', [
            'title' => 'Data User',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('user.create', [
            'title' => 'Tambah Data User',
        ]);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'name' => $request->input('nama'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', [
            'title' => 'Edit Data User',
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->input('password')) {
            $user->update([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'name' => $request->input('nama'),
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role'),
            ]);
        } else {
            $user->update([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'name' => $request->input('nama'),
                'role' => $request->input('role'),
            ]);
        }

        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->role == 'Guru') {
            $user->teacher->delete();
        } elseif ($user->role == 'DUDI') {
            $user->dudi->delete();
        } elseif ($user->role == 'Siswa') {
            $user->student->delete();
        }
        $user->delete();

        return redirect()->route('user.index');
    }
}
