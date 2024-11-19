<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceList extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'jam_masuk',
        'jam_pulang',
        'status',
        'keterangan',
        'foto',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
