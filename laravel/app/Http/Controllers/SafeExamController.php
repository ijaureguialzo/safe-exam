<?php

namespace App\Http\Controllers;

use App\Models\SafeExam;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SafeExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['config_seb', 'exit_seb']);
    }

    public function index()
    {
        $safe_exams = Auth::user()->safe_exams;

        return view('safe_exams.index', compact('safe_exams'));
    }

    public function reset_token(SafeExam $safe_exam)
    {
        $safe_exam->token = bin2hex(openssl_random_pseudo_bytes(8));
        $safe_exam->save();

        return back();
    }

    public function delete_token(SafeExam $safe_exam)
    {
        $safe_exam->token = null;
        $safe_exam->save();

        return back();
    }

    public function reset_quit_password(SafeExam $safe_exam)
    {
        $safe_exam->quit_password = bin2hex(openssl_random_pseudo_bytes(2));
        $safe_exam->save();

        return back();
    }

    public function delete_quit_password(SafeExam $safe_exam)
    {
        $safe_exam->quit_password = null;
        $safe_exam->save();

        return back();
    }

    public function config_seb(SafeExam $safe_exam)
    {
        $ruta = Storage::disk('seb')->path("/");

        $path = $ruta . "/template.xml";
        $xml = file_get_contents($path);

        $xml = Str::replace("IKASGELA_TOKEN", $safe_exam->token, $xml);
        $xml = Str::replace("IKASGELA_URL", "https://" . request()->getHost(), $xml);
        $xml = Str::replace("IKASGELA_QUIT_PASSWORD", hash("sha256", $safe_exam->quit_password), $xml);
        $xml = Str::replace("IKASGELA_EXIT_URL", route('safe_exam.exit_seb', hash("sha256", $safe_exam->quit_password)), $xml);

        return response()->streamDownload(function () use ($xml) {
            echo $xml;
        }, 'config.seb');
    }

    public function exit_seb()
    {
        return view('safe_exams.exit');
    }
}
