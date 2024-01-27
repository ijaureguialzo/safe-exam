<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SafeExam extends Model
{
    protected $fillable = [
        'classroom', 'url', 'token', 'quit_password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
