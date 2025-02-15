<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Models\Major;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

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

    public function import(Request $request){
        try {
            $file = $request->file('student_excel');
            if (!$file) {
                return back()->with('error', 'File tidak ditemukan'); 
            }

            Excel::import(new StudentImport, $file);

            return redirect()->route('siswa.index')->with('success', 'Berhasil Di Import');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $mn) {
            return back()->with('error', $mn->getMessage());
        } catch (ValidationException $ve) {
            return back()->with('error', $ve->getMessage());
        }
    }
}
