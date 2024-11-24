<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        if (!in_array(Auth::user()->role, ['Siswa', 'Admin'])) {
            abort(403, 'Forbidden');
        }
        $data = Student::all();
        if (Auth::user()->role === 'Siswa') {
            $data = Student::where('id', Auth::user()->student->id)->get();
        }

        return view('siswa.index', [
            'title' => 'Data Siswa',
            'data' => $data,
        ]);
    }

    public function create()
    {
        $this->authorize('admin');
        $majors = Major::all();

        return view('siswa.create', [
            'title' => 'Tambah Data Siswa',
            'majors' => $majors,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('admin');
        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'name' => $request->input('nama'),
            'role' => 'Siswa',
            'password' => Hash::make($request->input('password')),
        ]);

        Student::create([
            'major_id' => $request->input('major_id'),
            'user_id' => $user->id,
            'nis' => $request->input('nis'),
            'jk' => $request->input('jk'),
            'tmp_lhr' => $request->input('tmp_lhr'),
            'tgl_lhr' => $request->input('tgl_lhr'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
        ]);

        return redirect()->route('siswa.index');
    }

    public function edit($id)
    {
        if (!in_array(Auth::user()->role, ['Siswa', 'Admin'])) {
            abort(403, 'Forbidden');
        }
        $siswa = Student::find($id);
        $majors = Major::all();

        return view('siswa.edit', [
            'title' => 'Edit Data Siswa',
            'siswa' => $siswa,
            'majors' => $majors,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!in_array(Auth::user()->role, ['Siswa', 'Admin'])) {
            abort(403, 'Forbidden');
        }
        $siswa = Student::find($id);

        $siswa->update([
            'major_id' => $request->input('major_id'),
            'jk' => $request->input('jk'),
            'nis' => $request->input('nis'),
            'tmp_lhr' => $request->input('tmp_lhr'),
            'tgl_lhr' => $request->input('tgl_lhr'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
        ]);

        if ($request->input('password')) {
            User::find($siswa->user_id)->update([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'name' => $request->input('nama'),
                'role' => 'Siswa',
                'password' => Hash::make($request->input('password')),
            ]);
        } else {
            User::find($siswa->user_id)->update([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'name' => $request->input('nama'),
                'role' => 'Siswa',
            ]);
        }

        return redirect()->route('siswa.index');
    }

    public function destroy($id)
    {
        $this->authorize('admin');
        $siswa = Student::find($id);
        User::find($siswa->user_id)->delete();
        $siswa->delete();

        return redirect()->route('siswa.index');
    }
}
