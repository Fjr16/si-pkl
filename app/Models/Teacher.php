<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jk',
        'tmp_lhr',
        'tgl_lhr',
        'alamat',
        'no_hp',
        'golongan',
        'bidang_studi',
        'pend_terakhir',
        'gol_darah',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
