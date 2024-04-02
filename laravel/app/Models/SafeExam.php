<?php

namespace App\Models;

use Bkwld\Cloner\Cloneable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafeExam extends Model
{
    use Cloneable, HasFactory;

    protected $fillable = [
        'classroom', 'url', 'token', 'quit_password', 'user_id'
    ];

    protected $cloneable_relations = [
        'allowed_apps', 'allowed_urls',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allowed_apps()
    {
        return $this->hasMany(AllowedApp::class);
    }

    public function allowed_urls()
    {
        return $this->hasMany(AllowedUrl::class);
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
