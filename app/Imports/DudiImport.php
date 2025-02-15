<?php

namespace App\Imports;

use App\Models\Dudi;
use App\Models\User;
use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Maatwebsite\Excel\Concerns\WithValidation;

class DudiImport implements ToCollection, WithValidation, WithHeadingRow, WithSkipDuplicates
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function rules() : array {
        return [
            'email' => 'required|email|unique:users',
            'username' => 'required|string|unique:users',
            'name' => 'required',
            'role' => 'required',
            'password' => 'required',
            'pimpinan' => 'required|string',
            'nip' => 'required',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::create([
                'email' => $row['email'] ?? '',
                'username' => $row['username'] ?? '',
                'name' => $row['name'] ?? '',
                'role' => 'DUDI',
                'password' => Hash::make($row['password']),
            ]);
            $item = Dudi::create([
                'user_id' => $user->id,
                'pimpinan' => $row['pimpinan'] ?? '',
                'nip' => $row['nip'] ?? '',
                'alamat' => $row['alamat'] ?? '',
                'kota' => $row['kota'] ?? '',
                'no_hp' => $row['no_hp'] ?? '',
            ]);

            $arrJurusanId = explode(',', $row['jurusan_diterima']);

            $item->majors()->sync($arrJurusanId);
        }
    }
}
