<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Models\User;
use App\Models\PklData;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuru = Teacher::get()->count();
        $totalDudi = Dudi::get()->count();
        $totalStudent = Student::get()->count();
        $totalUser = User::get()->count();

        $data = PklData::latest()->limit(10)->get();
        $heading = 'Daftar Siswa PKL';
        $subHeading = '| 10 terbaru';
        if (Auth::user()->role === 'Siswa') {
            $data = PklData::where('student_id', Auth::user()->student->id)->get();
            $heading = 'Data Pkl';
            $subHeading = '| ' . Auth::user()->name ?? '';
        }
        if (Auth::user()->role === 'DUDI') {
            $data = PklData::where('dudi_id', Auth::user()->dudi->id)->get();
            $heading = 'Daftar Siswa PKL';
            $subHeading = '| ' . Auth::user()->name ?? '';
        }
        if (Auth::user()->role === 'Guru') {
            $data = PklData::where('teacher_id', Auth::user()->teacher->id)->get();
            $heading = 'Daftar Siswa Bimbingan';
            $subHeading = '| ' . Auth::user()->name ?? '';
        }
        return view('dashboard.dashboard', [
            'title' => 'Dashboard',
            'totalGuru' => $totalGuru,
            'totalDudi' => $totalDudi,
            'totalStudent' => $totalStudent,
            'totalUser' => $totalUser,
            'data' => $data,
            'heading' => $heading,
            'subHeading' => $subHeading,
        ]);
    }
}
