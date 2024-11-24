<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\PklData;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PklData::all();
        if (Auth::user()->role === 'Guru') {
            $data = PklData::where('teacher_id', Auth::user()->teacher->id)->get();
        }
        if (Auth::user()->role === 'DUDI') {
            $data = PklData::where('dudi_id', Auth::user()->dudi->id)->get();
        }
        if (Auth::user()->role === 'Siswa') {
            $data = PklData::where('student_id', Auth::user()->student->id)->get();
        }
        return view('sertifikat.index', [
            'title' => 'Data Sertifikat',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        if (!in_array(Auth::user()->role, ['DUDI', 'Guru'])) {
            abort(403, 'forbidden');
        }
        $item = PklData::find($id);
        return view('sertifikat.create', [
            'title' => 'Data Sertifikat',
            'item' => $item,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        if (!in_array(Auth::user()->role, ['DUDI', 'Guru'])) {
            abort(403, 'forbidden');
        }
        $item = PklData::find($id);
        $request->validate([
            'file_sertifikat' => 'required|mimes:pdf|max:2048',
        ]);

        $file_path = $request->file('file_sertifikat')->store('sertifikat_pkl', 'public');

        $certificate = new Certificate();
        $certificate->pkl_data_id = $item->id;
        $certificate->file_path = $file_path;
        $certificate->save();

        return redirect()->route('sertifikat.index')->with('success', 'berhasil diunggah');

    }

    /**
     * Display the specified resource.
     */
    public function download(string $id)
    {
        try {
            $item = Certificate::findOrFail($id);
            return Storage::disk('public')->download($item->file_path);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $mn) {
            return back()->with('error', $mn->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function signatureAdd(string $id)
    {
        $this->authorize('guru');
        $item = Certificate::find($id);
        return view('sertifikat.signature.create', [
            'title' => 'Data Sertifikat',
            'item' => $item,
        ]);
    }
    public function signatureStore(string $id, Request $request)
    {
        $this->authorize('guru');
        $item = Certificate::find($id);
        $request->validate([
            'signature' => 'required',
        ]);

        // Konversi Base64 ke Gambar
        $dir = 'signatures';
        $signaturePath = $dir . '/' . uniqid() . '_signature.png';
        $signatureData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->signature));

        // Periksa dan buat direktori jika belum ada
        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        Storage::disk('public')->put($signaturePath, $signatureData);


        $signaturePathPublic = storage_path('app/public/' . $signaturePath);
        $pdfPath = storage_path('app/public/' . $item->file_path);
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($pdfPath);

        for ($i = 1; $i <= $pageCount; $i++) {
            $templateId = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($templateId);
            // tambahkan halaman dengan ukuran asli
            $pdf->AddPage($size);
            $pdf->useTemplate($templateId);
    
            // Tambahkan tanda tangan di halaman terakhir
            if ($i === $pageCount) {

                // ambil dimensi halaman
                $pageWidth = $pdf->GetPageWidth();
                $pageHeight = $pdf->GetPageHeight();

                // p dan l tanda tangan
                $signatureWidth = 60;
                $signatureHeight = 40;

                // Periksa orientasi dokumen
                if ($pageWidth > $pageHeight) {
                    // Jika orientasi landscape
                    $x = ($pageWidth - $signatureWidth) / 4;
                    $y = $pageHeight - $signatureHeight - 40; // Jarak 10 mm dari tepi bawah
                } else {
                    // Jika orientasi portrait
                    $x = $pageWidth - $signatureWidth - 10; // Jarak 10 mm dari tepi kanan
                    $y = $pageHeight - $signatureHeight - 10; // Jarak 10 mm dari tepi bawah
                }

                $pdf->Image($signaturePathPublic, $x, $y, $signatureWidth, $signatureHeight);
            }
        }
        $newPdfFilePath = 'sertifikat_pkl/' . time() . '_signed.pdf';
        $outputPath = storage_path('app/public/' . $newPdfFilePath);
        $pdf->Output($outputPath, 'F');

        if ($item->file_path) {
            Storage::disk('public')->delete($item->file_path);
        }
        Storage::disk('public')->delete($signaturePath);

        $item->update([
            'status' => 'approved',
            'file_path' => $newPdfFilePath,
        ]);

        return redirect()->route('sertifikat.index')->with('success', 'Berhasil Divalidasi');

    }
}
