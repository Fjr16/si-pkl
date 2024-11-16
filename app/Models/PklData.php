<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklData extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'dudi_id',
        'teacher_id',
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }
    public function dudi() {
        return $this->belongsTo(Dudi::class);
    }
    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
}
