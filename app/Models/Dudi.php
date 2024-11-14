<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pimpinan',
        'nip',
        'alamat',
        'kota',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
