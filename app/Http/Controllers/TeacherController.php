<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $data = Teacher::all();

        return view('guru.index', [
            'title' => 'Data Guru',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('guru.create', [
            'title' => 'Tambah Data Guru',
        ]);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'name' => $request->input('nama'),
            'role' => 'Guru',
            'password' => Hash::make($request->input('password')),
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'jk' => $request->input('jk'),
            'tmp_lhr' => $request->input('tmp_lhr'),
            'tgl_lhr' => $request->input('tgl_lhr'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'golongan' => $request->input('golongan'),
            'bidang_studi' => $request->input('bidang_studi'),
            'pend_terakhir' => $request->input('pend_terakhir'),
            'gol_darah' => $request->input('gol_darah'),
            'jabatan' => $request->input('jabatan'),
        ]);

        return redirect()->route('guru.index');
    }

    public function edit($id)
    {
        $guru = Teacher::find($id);

        return view('guru.edit', [
            'title' => 'Edit Data Guru',
            'guru' => $guru,
        ]);
    }

    public function update(Request $request, $id)
    {
        $guru = Teacher::find($id);

        $guru->update([
            'jk' => $request->input('jk'),
            'tmp_lhr' => $request->input('tmp_lhr'),
            'tgl_lhr' => $request->input('tgl_lhr'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'golongan' => $request->input('golongan'),
            'bidang_studi' => $request->input('bidang_studi'),
            'pend_terakhir' => $request->input('pend_terakhir'),
            'gol_darah' => $request->input('gol_darah'),
            'jabatan' => $request->input('jabatan'),
        ]);

        if ($request->input('password')) {
            User::find($guru->user_id)->update([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'name' => $request->input('nama'),
                'role' => 'Guru',
                'password' => Hash::make($request->input('password')),
            ]);
        } else {
            User::find($guru->user_id)->update([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'name' => $request->input('nama'),
                'role' => 'Guru',
            ]);
        }

        return redirect()->route('guru.index');
    }

    public function destroy($id)
    {
        $guru = Teacher::find($id);
        User::find($guru->user_id)->delete();
        $guru->delete();

        return redirect()->route('guru.index');
    }
}
