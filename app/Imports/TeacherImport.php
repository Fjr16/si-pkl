<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Maatwebsite\Excel\Concerns\WithValidation;

class TeacherImport implements ToCollection, WithSkipDuplicates, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function rules(): array
    {
        return [
            'email' => 'required|unique:users|email',
            'username' => 'required|string|unique:users',
            'name' => 'required',
            'role' => 'required',
            'password' => 'required',
            'jk' => 'nullable|string',
            'tmp_lhr' => 'nullable|string',
            'tgl_lhr' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'golongan' => 'nullable|string',
            'bidang_studi' => 'nullable|string',
            'pend_terakhir' => 'nullable|string',
            'gol_darah' => 'nullable|string',
            'jabatan' => 'nullable|string',
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::create([
                'email' => $row['email'] ?? '',
                'username' => $row['username'] ?? '',
                'name' => $row['name'] ?? '',
                'role' => 'Guru',
                'password' => Hash::make($row['password']),
            ]);
            Teacher::create([
                'user_id' => $user->id,
                'jk' => $row['jenis_kelamin'] ?? '',
                'tmp_lhr' => $row['tempat _lahir'] ?? '',
                'tgl_lhr' => $row['tanggal _lahir'] ?? '',
                'alamat' => $row['alamat'] ?? '',
                'no_hp' => $row['hp'] ?? '',
                'golongan' => $row['golongan'] ?? '',
                'bidang_studi' => $row['bidang_studi'] ?? '',
                'pend_terakhir' => $row['pendidikan_terakhir'] ?? '',
                'gol_darah' => $row['gol_darah'] ?? '',
                'jabatan' => $row['jabatan'] ?? '',
            ]);
        }
    }
}
