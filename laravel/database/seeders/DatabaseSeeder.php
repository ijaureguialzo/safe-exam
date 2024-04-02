<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AllowedApp;
use App\Models\AllowedUrl;
use App\Models\SafeExam;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => bcrypt('12345Abcde'),
            'email_verified_at' => now(),
        ]);

        $safe_exam = SafeExam::create([
            'classroom' => 'test',
            'url' => 'https://api.socrative.comm/fake/123456',
            'token' => SafeExam::new_token(),
            'quit_password' => SafeExam::new_quit_password(),
            'user_id' => $user->id,
        ]);

        AllowedApp::create([
            'title' => 'IntelliJ IDEA',
            'executable' => 'idea64.exe',
            'path' => '%LOCALAPPDATA%\programs\intellij idea community edition\bin',
            'show_icon' => true,
            'force_close' => false,
            'safe_exam_id' => $safe_exam->id,
        ]);

        AllowedApp::create([
            'title' => 'JetBrains Toolbox',
            'executable' => 'jetbrains-toolbox.exe',
            'path' => '%LOCALAPPDATA%\jetbrains\toolbox\bin',
            'show_icon' => false,
            'force_close' => true,
            'safe_exam_id' => $safe_exam->id,
        ]);

        AllowedApp::create([
            'title' => 'Git Credential Manager (admin)',
            'executable' => 'git-credential-manager.exe',
            'path' => '%PROGRAMFILES%\Git\mingw64\bin',
            'show_icon' => false,
            'force_close' => true,
            'safe_exam_id' => $safe_exam->id,
        ]);

        AllowedApp::create([
            'title' => 'Git Credential Manager (user)',
            'executable' => 'git-credential-manager.exe',
            'path' => '%LOCALAPPDATA%\Programs\Git\mingw64\bin',
            'show_icon' => false,
            'force_close' => true,
            'safe_exam_id' => $safe_exam->id,
        ]);

        AllowedApp::create([
            'title' => 'GitKraken',
            'executable' => 'gitkraken.exe',
            'path' => '%LOCALAPPDATA%\gitkraken',
            'show_icon' => true,
            'force_close' => false,
            'safe_exam_id' => $safe_exam->id,
        ]);

        AllowedUrl::create([
            'url' => 'jetbrains://*',
            'safe_exam_id' => $safe_exam->id,
        ]);

        AllowedUrl::create([
            'url' => 'gitkraken://*',
            'safe_exam_id' => $safe_exam->id,
        ]);

        AllowedUrl::create([
            'url' => 'https://es.wikipedia.org',
            'safe_exam_id' => $safe_exam->id,
        ]);
    }
}
