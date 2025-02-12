<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JurnalHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('siswa');
        $data = DailyReport::where('student_id', Auth::user()->student->id)->get();
        return view('jurnal-harian.index', [
            'title' => 'Jurnal Harian',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('siswa');
        return view('jurnal-harian.create', [
            'title' => 'Jurnal Harian',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('siswa');
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'jenis_laporan' => 'required|string',
            'keterangan' => 'nullable|string',
            'file_laporan' => 'required|mimes:pdf|max:2048', // Maksimal 2MB
        ]);
        if (Auth::user()->student->id != $request->student_id) {
            return back()->with('error', 'Anda tidak dapat mewakili laporan siswa lain');
        }

        $file = $request->file('file_laporan');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file_path = $file->storeAs('laporan-harian-siswa', $file_name, 'public');
        $file_size = $file->getSize() / (1024 * 1024);

        DailyReport::create([
            'student_id' => Auth::user()->student->id,
            'jenis_laporan' => $request->jenis_laporan,
            'keterangan' => $request->keterangan ?? null,
            'file_name' => $file_name,
            'file_path' => $file_path,
            'file_size' => round($file_size, 2),
        ]);

        return redirect()->route('jurnal/harian.index')->with('success', 'Laporan Harian berhasil di unggah');
        
    }

    /**
     * Display the specified resource.
     */
    public function download(string $id)
    {
        try {
            $item = DailyReport::findOrFail($id);
            return Storage::disk('public')->download($item->file_path, $item->file_name);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $mn) {
            return back()->with('error', $mn->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('siswa');
        $item = DailyReport::find($id);
        return view('jurnal-harian.edit', [
            'title' => 'Jurnal Harian',
            'item' => $item,
        ]);
    }

    public function show(String $id) {
        $data = DailyReport::where('student_id', decrypt($id))->get();
        return view('jurnal-harian.index', [
            'title' => 'Jurnal Harian',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('siswa');
        $item = DailyReport::findOrFail($id);
        $request->validate([
            'jenis_laporan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);
        if (Auth::user()->student->id != $item->student_id) {
            return back()->with('error', 'Anda tidak dapat mewakili laporan siswa lain');
        }

        $data = [
            'student_id' => Auth::user()->student->id,
            'jenis_laporan' => $request->jenis_laporan,
            'keterangan' => $request->keterangan ?? null,
        ];

        if ($request->file('file_laporan')) {
            $request->validate([
                'file_laporan' => 'required|mimes:pdf|max:2048', // Maksimal 2MB
            ]);
            
            // hapus laporan lama
            if ($item->file_path) {
                Storage::disk('public')->delete($item->file_path);
            }

            $file = $request->file('file_laporan');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file_path = $file->storeAs('laporan-harian-siswa', $file_name, 'public');
            $file_size = $file->getSize() / (1024 * 1024);
            $data['file_name'] = $file_name;
            $data['file_path'] = $file_path;
            $data['file_size'] = round($file_size, 2);
        }

        $item->update($data);

        return redirect()->route('jurnal/harian.index')->with('success', 'Laporan Harian berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('siswa');
        $item = DailyReport::find($id);
        if (Auth::user()->student->id != $item->student_id) {
            return back()->with('error', 'Anda tidak dapat mewakili laporan siswa lain');
        }
        if ($item->file_path) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();
        return back()->with('success', 'Berhasil Dihapus');
    }
}
