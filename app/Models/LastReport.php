<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'tanggal',
        'file_name',
        'file_path',
        'file_size',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
