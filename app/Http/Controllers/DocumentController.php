<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Document::latest()->get();
        return view('dokumen.index', [
            'title' => 'Daftar Dokumen',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('guru');
        return view('dokumen.create', [
            'title' => 'Daftar Dokumen',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('guru');
        $request->validate([
            'tanggal' => 'required|date', 
            'dokumen' => 'required|mimes:pdf|max:5120', // Maksimal 5MB
        ]);

        $file = $request->file('dokumen');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('dokumen-lainnya', $fileName, 'public');
        $file_size = $file->getSize() / (1024 * 1024);
       
        // Simpan metadata ke database
        Document::create([
            'teacher_id' => Auth::user()->teacher->id,
            'tanggal' => $request->tanggal,
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_size' => round($file_size, 2),
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen Berhasil Diunggah!');
    }


    public function download($id)
    {
        try {
            $item = Document::findOrFail($id);
            return Storage::disk('public')->download($item->file_path, $item->file_name);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $mn){
            return back()->with('error', $mn->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('guru');
        try {
            $item = Document::findOrFail($id);
            Storage::disk('public')->delete($item->file_path);
            $item->delete();

            return back()->with('success', 'Berhasil Dihapus');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $mn) {
            return back()->with('error', $mn->getMessage());
        }
    }
}
