<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DudiController extends Controller
{
    public function index()
    {
        $data = Dudi::all();

        return view('dudi.index', [
            'title' => 'Data DUDI',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('dudi.create', [
            'title' => 'Tambah Data DUDI',
        ]);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'name' => $request->input('nama'),
            'role' => 'DUDI',
            'password' => Hash::make($request->input('password')),
        ]);

        Dudi::create([
            'user_id' => $user->id,
            'pimpinan' => $request->input('pimpinan'),
            'nip' => $request->input('nip'),
            'alamat' => $request->input('alamat'),
            'kota' => $request->input('kota'),
            'no_hp' => $request->input('no_hp'),
        ]);

        return redirect()->route('dudi.index');
    }

    public function edit($id)
    {
        $dudi = Dudi::find($id);

        return view('dudi.edit', [
            'title' => 'Edit Data DUDI',
            'dudi' => $dudi,
        ]);
    }

    public function update(Request $request, $id)
    {
        $dudi = Dudi::find($id);

        $dudi->update([
            'pimpinan' => $request->input('pimpinan'),
            'nip' => $request->input('nip'),
            'alamat' => $request->input('alamat'),
            'kota' => $request->input('kota'),
            'no_hp' => $request->input('no_hp'),
        ]);

        if ($request->input('password')) {
            User::find($dudi->user_id)->update([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'name' => $request->input('nama'),
                'role' => 'DUDI',
                'password' => Hash::make($request->input('password')),
            ]);
        } else {
            User::find($dudi->user_id)->update([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'name' => $request->input('nama'),
                'role' => 'DUDI',
            ]);
        }

        return redirect()->route('dudi.index');
    }

    public function destroy($id)
    {
        $dudi = Dudi::find($id);
        User::find($dudi->user_id)->delete();
        $dudi->delete();

        return redirect()->route('dudi.index');
    }
}
