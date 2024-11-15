<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        $data = Major::all();
        return view('dudi.create', [
            'title' => 'Tambah Data DUDI',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'major_id' => 'required|array',
                'major_id.*' => 'required|string'
            ], [
                'major_id.array' => 'Jurusan yang diterima harus berupa array',
                'major_id.required' => 'Jurusan yang diterima harus dipilih',
                'major_id.*.required' => 'Jurusan yang diterima harus dipilih',
                'major_id.*.string' => 'Jurusan yang diterima harus berupa string',
            ]);
        } catch (ValidationException $ve) {
            return back()->with('error', $ve->getMessage());
        }
        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'name' => $request->input('nama'),
            'role' => 'DUDI',
            'password' => Hash::make($request->input('password')),
        ]);

        $item = Dudi::create([
            'user_id' => $user->id,
            'pimpinan' => $request->input('pimpinan'),
            'nip' => $request->input('nip'),
            'alamat' => $request->input('alamat'),
            'kota' => $request->input('kota'),
            'no_hp' => $request->input('no_hp'),
        ]);

        $item->majors()->sync($request->major_id);

        return redirect()->route('dudi.index');
    }

    public function edit($id)
    {
        $dudi = Dudi::find($id);
        $data = Major::all();
        return view('dudi.edit', [
            'title' => 'Edit Data DUDI',
            'dudi' => $dudi,
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'major_id' => 'required|array',
                'major_id.*' => 'required|string'
            ], [
                'major_id.array' => 'Jurusan yang diterima harus berupa array',
                'major_id.required' => 'Jurusan yang diterima harus dipilih',
                'major_id.*.required' => 'Jurusan yang diterima harus dipilih',
                'major_id.*.string' => 'Jurusan yang diterima harus berupa string',
            ]);
        } catch (ValidationException $ve) {
            return back()->with('error', $ve->getMessage());
        }

        $dudi = Dudi::find($id);

        $dudi->update([
            'pimpinan' => $request->input('pimpinan'),
            'nip' => $request->input('nip'),
            'alamat' => $request->input('alamat'),
            'kota' => $request->input('kota'),
            'no_hp' => $request->input('no_hp'),
        ]);
        $dudi->majors()->sync($request->major_id);


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
