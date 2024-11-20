<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        // 'tanggal', dari timestamp created_at
        'jenis_laporan',
        'keterangan',
        'file_path',
        'file_name',
        'file_size',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
