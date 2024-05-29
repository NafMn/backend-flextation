<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'comment_id';
    protected $fillable = ['user_id', 'commenter_name', 'content', 'kehadiran'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
