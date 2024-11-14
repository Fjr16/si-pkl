<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $data = Major::all();

        return view('jurusan.index', [
            'title' => 'Data Jurusan',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('jurusan.create', [
            'title' => 'Tambah Data Jurusan',
        ]);
    }

    public function store(Request $request)
    {
        Major::create([
            'kode' => $request->input('kode'),
            'nama' => $request->input('nama'),
        ]);

        return redirect()->route('jurusan.index');
    }

    public function edit($id)
    {
        $jurusan = Major::find($id);

        return view('jurusan.edit', [
            'title' => 'Edit Data Jurusan',
            'jurusan' => $jurusan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $jurusan = Major::find($id);

        $jurusan->update([
            'kode' => $request->input('kode'),
            'nama' => $request->input('nama'),
        ]);

        return redirect()->route('jurusan.index');
    }

    public function destroy($id)
    {
        $jurusan = Major::find($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index');
    }
}
