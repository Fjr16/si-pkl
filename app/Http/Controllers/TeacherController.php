<?php

namespace App\Http\Controllers;

use App\Imports\TeacherImport;
use App\Models\User;
use App\Models\Teacher;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    public function index()
    {
        if (!in_array(Auth::user()->role, ['Admin','Guru'])) {
            abort(403, 'Forbidden');
        }
        $data = Teacher::all();
        if (Auth::user()->role === 'Guru') {
            $data = Teacher::where('id', Auth::user()->teacher->id)->get();
        }
        return view('guru.index', [
            'title' => 'Data Guru',
            'data' => $data,
        ]);
    }

    public function create()
    {
        $this->authorize('admin');
        return view('guru.create', [
            'title' => 'Tambah Data Guru',
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('admin');
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
        if (!in_array(Auth::user()->role, ['Admin','Guru'])) {
            abort(403, 'Forbidden');
        }
        $guru = Teacher::find($id);

        return view('guru.edit', [
            'title' => 'Edit Data Guru',
            'guru' => $guru,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!in_array(Auth::user()->role, ['Admin','Guru'])) {
            abort(403, 'Forbidden');
        }
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
        $this->authorize('admin');
        $guru = Teacher::find($id);
        User::find($guru->user_id)->delete();
        $guru->delete();

        return redirect()->route('guru.index');
    }

    public function import(Request $request){
        try {
            $file = $request->file('teacher_excel');
    
            if ($file) {
               Excel::import(new TeacherImport, $file);
            }else{
                return back()->with('error', 'File Tidak Ditemukan');
            }
    
            return redirect()->route('guru.index')->with('success', 'Berhasil Di import');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $mn) {
            return back()->with('error', $mn->getMessage());
        } catch (ValidationException $ve) {
            return back()->with('error', $ve->getMessage());
        }
    }
}
