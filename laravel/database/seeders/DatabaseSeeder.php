<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SafeExam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => '$2y$12$kPgMZ8H33vcLyh7ICJKkr.CReGwe28EjiYz0ayScPZ.tv3Gg.htxG',   // 12345Abcde
            'email_verified_at' => now(),
        ]);

        DB::table('safe_exams')->insert([
            'classroom' => 'test',
            'url' => 'https://api.socrative.comm/fake/123456',
            'token' => SafeExam::new_token(),
            'quit_password' => SafeExam::new_quit_password(),
            'user_id' => 1,
        ]);

        DB::table('allowed_apps')->insert([
            'title' => 'idea64',
            'executable' => 'idea64.exe',
            'path' => '%LOCALAPPDATA%\programs\intellij idea community edition\bin',
            'show_icon' => true,
            'force_close' => false,
            'safe_exam_id' => 1,
        ]);
    }
}
