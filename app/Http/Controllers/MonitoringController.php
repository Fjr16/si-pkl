<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TeacherMonitoring;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('guru');
        $data = TeacherMonitoring::where('teacher_id', Auth::user()->teacher->id)->get();
        return view('monitoring.index', [
            'title' => 'Monitoring Guru',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('guru');
        $guruId = Auth::user()->teacher->id;
        $data = Student::whereHas('pklData', function ($item) use ($guruId){
            $item->where('teacher_id', $guruId);
        })->get();
        return view('monitoring.create', [
            'title' => 'Monitoring Guru',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'teacher_id' => 'required|exists:teachers,id',
                'student_id' => 'required|exists:students,id',
                'kejadian' => 'string|nullable',
                'keterangan' => 'string|nullable',
                'tindakan' => 'string|nullable',
                'dokumentasi' => 'required|image|mimes:jpeg,png,jpg|max:1048',
            ],[
                'dokumentasi.required' => 'Foto wajib diunggah.',
                'dokumentasi.image' => 'File harus berupa gambar.',
                'dokumentasi.mimes' => 'Format gambar harus JPEG, PNG, JPG',
                'dokumentasi.max' => 'Ukuran gambar tidak boleh lebih dari 1 MB.',
            ]);
    
            $path = $request->file('dokumentasi')->store('dokumentasi-monitoring', 'public');
            $data['dokumentasi'] = $path;
    
            TeacherMonitoring::create($data);
    
            return redirect()->route('monitoring/guru.index')->with('success', 'berhasil Ditambahkan');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        } catch (ValidationException $ve) {
            return back()->with('error', $ve->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('guru');
        $guruId = Auth::user()->teacher->id;
        $item = TeacherMonitoring::find($id);
        $data = Student::whereHas('pklData', function ($item) use ($guruId){
            $item->where('teacher_id', $guruId);
        })->get();
        return view('monitoring.edit', [
            'title' => 'Monitoring Guru',
            'data' => $data,
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $item = TeacherMonitoring::findOrFail($id);

            $data = $request->validate([
                'student_id' => 'required|exists:students,id',
                'kejadian' => 'string|nullable',
                'keterangan' => 'string|nullable',
                'tindakan' => 'string|nullable',
            ]);
            if ($request->file('dokumentasi')) {
                $request->validate([
                    'dokumentasi' => 'required|image|mimes:jpeg,png,jpg|max:1048',
                ],[
                    'dokumentasi.required' => 'Foto wajib diunggah.',
                    'dokumentasi.image' => 'File harus berupa gambar.',
                    'dokumentasi.mimes' => 'Format gambar harus JPEG, PNG, JPG',
                    'dokumentasi.max' => 'Ukuran gambar tidak boleh lebih dari 1 MB.',
                ]);

                if ($item->dokumentasi) {
                    Storage::disk('public')->delete($item->dokumentasi);
                }

                $path = $request->file('dokumentasi')->store('dokumentasi-monitoring', 'public');
                $data['dokumentasi'] = $path;
            }
    
    
            $item->update($data);
    
            return redirect()->route('monitoring/guru.index')->with('success', 'Berhasil diperbarui');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        } catch (ValidationException $ve) {
            return back()->with('error', $ve->getMessage());
        } catch (ModelNotFoundException $mn) {
            return back()->with('error', $mn->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('guru');
        $item = TeacherMonitoring::find($id);
        if (Auth::user()->teacher->id !== $item->teacher_id) {
            return back()->with('error', 'Anda Tidak Dapat menghapus laporan monitoring guru lain');
        }
        if ($item->dokumentasi) {
            Storage::disk('public')->delete($item->dokumentasi);
        }
        $item->delete();
        return back()->with('success', 'Berhasil Dihapus');

    }
    public function getPklData(string $id)
    {
        try {
            $item = Student::findOrFail($id);
            $jurusan = $item->major->nama ?? '-';
            $nama_perusahaan = $item->pklData->dudi->user->name ?? '-';
            $data = [
                'jurusan' => $jurusan,
                'nama_perusahaan' => $nama_perusahaan,
            ];
            return response()->json([
                'message' => 'success',
                'data' => $data,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 500);
        } catch (ModelNotFoundException $mn) {
            return response()->json([
                'message' => 'error',
                'error' => $mn->getMessage()
            ], 500);
        }
    }
}
