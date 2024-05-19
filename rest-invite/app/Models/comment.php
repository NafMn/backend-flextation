<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'comment', 'kehadiran'];

    protected $rules = [
        'kehadiran' => 'in:hadir,belum tahu,tidak hadir', // aturan validasi untuk kolom 'kehadiran'
    ];
}
