<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Models\PklData;
use App\Models\Student;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PklController extends Controller
{
    private function checkStudentAlreadyHasPkl($student_id, $old_id) {
        if ($old_id) {
            $data = PklData::where('student_id', $student_id)->whereNot('id', $old_id)->first();
        }else{
            $data = PklData::where('student_id', $student_id)->first();
        }
        if ($data) {
            return true;
        }
        return false;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PklData::all();
        if (Auth::user()->role === 'DUDI') {
            $data = PklData::where('dudi_id', Auth::user()->dudi->id)->get();
        }
        if (Auth::user()->role === 'Guru') {
            $data = PklData::where('teacher_id', Auth::user()->teacher->id)->get();
        }
        return view('data-pkl.index', [
            'title' => 'Data PKL Siswa',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('admin');
        $data = Student::with('major')->whereDoesntHave('pklData')->get();
        $teachers = Teacher::all();
        return view('data-pkl.create', [
            'title' => 'Data PKL Siswa',
            'data' => $data,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('admin');
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'dudi_id' => 'required|exists:dudis,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $checkDuplicateStudent = $this->checkStudentAlreadyHasPkl($data['student_id'], null);

        if ($checkDuplicateStudent) {
            return back()->with('error', 'Gagal !! Data Pkl Siswa Telah Ada, Setiap Siswa hanya bisa memiliki satu data PKL');
        }

        PklData::create($data);

        return redirect()->route('data/pkl/siswa.index')->with('success', 'Berhasil Ditambahkan');
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
        $this->authorize('admin');
        $data = Student::with('major')->get();
        $teachers = Teacher::all();
        $item = PklData::find($id);
        $majorId = $item->student->major_id;
        $dataDudis = Dudi::whereHas('majors', function($major) use ($majorId){
            $major->where('major_id', $majorId);
        })->with('user')->get();
        return view('data-pkl.edit', [
            'title' => 'Data PKL Siswa',
            'item' => $item,
            'data' => $data,
            'teachers' => $teachers,
            'dataDudis' => $dataDudis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('admin');
        $item = PklData::find($id);
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'dudi_id' => 'required|exists:dudis,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $checkDuplicateStudent = $this->checkStudentAlreadyHasPkl($data['student_id'], $item->id);

        if ($checkDuplicateStudent) {
            return back()->with('error', 'Gagal !! Data Pkl Siswa Telah Ada, Setiap Siswa hanya bisa memiliki satu data PKL');
        }

        $item->update($data);

        return redirect()->route('data/pkl/siswa.index')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('admin');
        $item = PklData::find($id);
        $item->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function getDataDudi(string $id)
    {
        $this->authorize('admin');
        try {
            $data = Dudi::whereHas('majors', function ($major) use ($id) {
                $major->where('major_id', $id);
            })->with('user')->get();
            if ($data->isEmpty()) {
                return response()->json([
                    'message' => 'No data Found',
                    'data' => [],
                ], 404);
            }
            return response()->json([
                'message' => 'success',
                'data' => $data,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
