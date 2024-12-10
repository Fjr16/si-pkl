<?php

namespace App\Http\Controllers;

use App\Models\LastReport;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanAkhirController extends Controller
{

    private function checkDuplicate($student_id) {
        $item = LastReport::where('student_id', $student_id)->first();
        if ($item) {
            return $item;
        }
        return false;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('siswa');
        $item = LastReport::where('student_id', Auth::user()->student->id)->first() ?? null;
        return view('laporan-akhir.create', [
            'title' => 'Laporan Akhir',
            'item' => $item,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('siswa');
        $request->validate([
            'tanggal' => 'required|date', 
            'laporan_akhir' => 'required|mimes:pdf|max:5120', // Maksimal 5MB
        ]);

        $file = $request->file('laporan_akhir');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('laporan-akhir-siswa', $fileName, 'public');
        $file_size = $file->getSize() / (1024 * 1024);

        $item = $this->checkDuplicate(Auth::user()->student->id);
        if ($item) {
            Storage::disk('public')->delete($item->file_path);
            $item->update([
                'tanggal' => $request->tanggal,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_size' => round($file_size, 2),
            ]);
        }else{
            // Simpan metadata ke database
            LastReport::create([
                'student_id' => Auth::user()->student->id,
                'tanggal' => $request->tanggal,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_size' => round($file_size, 2),
            ]);
        }

        return back()->with('success', 'Laporan Berhasil Diunggah!');
    }

    public function download($id)
    {
        try {
            $item = LastReport::findOrFail($id);
            return Storage::disk('public')->download($item->file_path, $item->file_name);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $mn){
            return back()->with('error', $mn->getMessage());
        }
    }

    public function show(String $id)
    {
        $item = LastReport::where('student_id', decrypt($id))->first() ?? null;
        return view('laporan-akhir.create', [
            'title' => 'Laporan Akhir',
            'item' => $item,
        ]);
    }
}
