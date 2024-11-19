<?php

namespace App\Http\Controllers;

use App\Models\AttendanceList;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AbsensiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AttendanceList::latest()->get();
        if (Auth::user()->role === 'Siswa') {
            $data = AttendanceList::where('student_id', Auth::user()->student->id)->latest()->get();
        }
        return view('absensi.index', [
            'title' => 'Presensi Siswa',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('siswa');
        return view('absensi.create', [
            'title' => 'Presensi Siswa',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'jam_masuk' => 'required|date_format:H:i',
                'jam_pulang' => 'required|date_format:H:i',
                'status' => 'required|in:Hadir,Sakit,Izin',
                'keterangan' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:1048',
            ], [
                'foto.required' => 'Foto wajib diunggah.',
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG',
                'foto.max' => 'Ukuran gambar tidak boleh lebih dari 1 MB.',
            ]);
        } catch (ValidationException $va) {
            return back()->with('error', $va->getMessage());
        }

        $path = $request->file('foto')->store('foto-presensi', 'public');
        $data = [
            'student_id' => $request->student_id,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'status' => $request->status,
            'keterangan' => $request->keterangan ?? '',
            'foto' => $path,
        ];
        AttendanceList::create($data);

        return redirect()->route('absensi/siswa.index')->with('success', 'Presensi Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('siswa');
        $item = AttendanceList::find($id);
        return view('absensi.edit', [
            'title' => 'Presensi Siswa',
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('siswa');
        $item = AttendanceList::find($id);
        try {
            $request->validate([
                'jam_masuk' => 'required|date_format:H:i',
                'jam_pulang' => 'required|date_format:H:i',
                'status' => 'required|in:Hadir,Sakit,Izin',
                'keterangan' => 'required',
            ]);
            if($request->file('foto')){
                $request->validate([
                    'foto' => 'required|image|mimes:jpeg,png,jpg|max:1048',
                ], [
                    'foto.required' => 'Foto wajib diunggah.',
                    'foto.image' => 'File harus berupa gambar.',
                    'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG',
                    'foto.max' => 'Ukuran gambar tidak boleh lebih dari 1 MB.',
                ]);
            }
        } catch (ValidationException $va) {
            return back()->with('error', $va->getMessage());
        }


        $data = [
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'status' => $request->status,
            'keterangan' => $request->keterangan ?? '',
        ];

        if ($request->file('foto')) {
            // delete foto lama
            if ($item->foto) {
                Storage::disk('public')->delete($item->foto); // Hapus file foto lama
            }
            $data['foto'] = $request->file('foto')->store('foto-presensi', 'public');
        }
        $item->update($data);

        return redirect()->route('absensi/siswa.index')->with('success', 'Presensi Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('siswa');
        
        $item = AttendanceList::find($id);
        if ($item->student->user->id !== Auth::user()->id) {
            return back()->with('error', 'Anda Hanya Dapat menghapus absensi anda sendiri');
        }
        if ($item->foto) {
            Storage::disk('public')->delete($item->foto); // Hapus file foto lama
        }
        $item->delete();
        return back()->with('success', 'Berhasil Dihapus');
    }
}
