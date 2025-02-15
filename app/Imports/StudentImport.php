<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function sheets(): array
    {
        return [
            'data-siswa' => new FirstSheetImport(),
        ];
    }  
}

class FirstSheetImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'username' => 'required|string|unique:users',
            'name' => 'required',
            'role' => 'required',
            'password' => 'required',
            'jurusan_id' => 'required|exists:majors,id',
            'nis' => 'required',
            'jenis_kelamin' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tgl_lahir' => 'nullable',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable',
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::create([
                'email' => $row['email'] ?? '',
                'username' => $row['username'] ?? '',
                'name' => $row['name'] ?? '',
                'role' => 'Siswa',
                'password' => Hash::make($row['password']),
            ]);
            Student::create([
                'user_id' => $user->id,
                'major_id' => $row['jurusan_id'] ?? '',
                'nis' => $row['nis'] ?? '',
                'jk' => $row['jenis_kelamin'] ?? '',
                'tmp_lhr' => $row['tempat_lahir'] ?? '',
                'tgl_lhr' => $row['tgl_lahir'] ?? '',
                'alamat' => $row['alamat'] ?? '',
                'no_hp' => $row['no_hp'] ?? '',
            ]);
        }
    }
}
