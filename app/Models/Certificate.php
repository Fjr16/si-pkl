<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'pkl_data_id',
        'file_path',
        'status',
    ];

    public function pklData(){
        return $this->belongsTo(PklData::class);
    }
}
