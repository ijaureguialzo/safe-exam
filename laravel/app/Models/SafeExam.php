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

    public static function new_token()
    {
        return bin2hex(openssl_random_pseudo_bytes(config('safe_exam.token_bytes')));
    }

    public static function new_quit_password()
    {
        return bin2hex(openssl_random_pseudo_bytes(config('safe_exam.quit_password_bytes')));
    }
}
