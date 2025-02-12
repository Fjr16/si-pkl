<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'teacher_id',
        'tanggal',
        'file_name',
        'file_path',
        'file_size',
    ];


    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
