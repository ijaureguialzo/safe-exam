<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ]);

        DB::table('safe_exams')->insert([
            'classroom' => 'test',
            'url' => 'https://api.socrative.comm/fake/123456',
            'token' => bin2hex(openssl_random_pseudo_bytes(config('safe_exam.token_bytes'))),
            'quit_password' => bin2hex(openssl_random_pseudo_bytes(config('safe_exam.quit_password_bytes'))),
            'user_id' => 1,
        ]);
    }
}
