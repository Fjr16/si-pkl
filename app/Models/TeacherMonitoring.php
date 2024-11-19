<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherMonitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'student_id',
        // 'pkl_data_id',
        'kejadian',
        'keterangan',
        'tindakan',
        'dokumentasi',
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
    // public function pklData(){
    //     return $this->belongsTo(PklData::class);
    // }
}
