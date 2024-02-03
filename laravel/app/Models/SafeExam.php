<?php

namespace App\Models;

use Bkwld\Cloner\Cloneable;
use Illuminate\Database\Eloquent\Model;

class SafeExam extends Model
{
    use Cloneable;

    protected $fillable = [
        'classroom', 'url', 'token', 'quit_password', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
