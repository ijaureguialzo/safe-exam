<?php

namespace App\Http\Controllers;

use App\Models\SafeExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jenssegers\Agent\Facades\Agent;

class SafeExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['config_seb', 'enter_seb', 'exit_seb']);
    }

    public function index()
    {
        $safe_exams = Auth::user()->safe_exams;

        return view('safe_exams.index', compact('safe_exams'));
    }

    public function create()
    {
        return view('safe_exams.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'classroom' => 'required',
            'url' => 'required',
        ]);

        SafeExam::create([
            'classroom' => request('classroom'),
            'url' => request('url'),
            'token' => bin2hex(openssl_random_pseudo_bytes(config('safe_exam.token_bytes'))),
            'quit_password' => bin2hex(openssl_random_pseudo_bytes(config('safe_exam.quit_password_bytes'))),
            'user_id' => Auth::user()->id,
        ]);

        return redirect(route('safe_exams.index'));
    }

    public function edit(SafeExam $safe_exam)
    {
        return view('safe_exams.edit', compact('safe_exam'));
    }

    public function update(Request $request, SafeExam $safe_exam)
    {
        $this->validate($request, [
            'classroom' => 'required',
            'url' => 'required',
        ]);

        $safe_exam->update([
            'classroom' => request('classroom'),
            'url' => request('url'),
        ]);

        return redirect(route('safe_exams.index'));
    }

    public function destroy(SafeExam $safe_exam)
    {
        $safe_exam->delete();

        return back();
    }

    public function reset_token(SafeExam $safe_exam)
    {
        $safe_exam->token = bin2hex(openssl_random_pseudo_bytes(config('safe_exam.token_bytes')));
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
        $safe_exam->quit_password = bin2hex(openssl_random_pseudo_bytes(config('safe_exam.quit_password_bytes')));
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

    public function enter_seb(Request $request)
    {
        $safe_exam = SafeExam::where('classroom', request('classroom'))->firstOrFail();

        $seb_session = Str::contains(Agent::getUserAgent(), "SEB/ikasgela (" . $safe_exam->token . ")");

        return view('safe_exams.enter', compact('safe_exam'));
    }

    public function exit_seb()
    {
        return view('safe_exams.exit');
    }
}
