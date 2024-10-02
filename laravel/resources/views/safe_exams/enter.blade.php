@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-6 pt-3 text-center">
            @if($seb_session)
                <a class="btn btn-success d-block py-5 mb-5 fs-2"
                   href="{{ $safe_exam->url }}">{{ __('Click here to open the application') }}</a>
                <a class="btn btn-danger d-block fs-5"
                   href="{{ $sebs_exit_url }}">{{ __('Click here to exit Safe Exam Browser') }}</a>
            @else
                <a class="btn btn-primary d-block py-5 mb-4 fs-2"
                   href="{{ $sebs_url }}">{{ __('Click here to open Safe Exam Browser') }}</a>
                <p class="small">
                    {{ __('If the button doesn\'t work, you will have to') }}
                    {{ __('download and install Safe Exam Browser') }}.
                </p>
                <p class="small">{{ __('Download it here') }}:
                    <a class="link-primary link-underline-opacity-0 link-underline-opacity-100-hover"
                       target="_blank"
                       href="{{ asset('/seb/SEB_SetupBundle.exe') }}">Windows</a>
                    <span>|</span>
                    <a class="link-primary link-underline-opacity-0 link-underline-opacity-100-hover"
                       target="_blank"
                       href="{{ asset('/seb/SafeExamBrowser.dmg') }}">macOS</a>
                </p>
            @endif
        </div>
    </div>

@endsection
