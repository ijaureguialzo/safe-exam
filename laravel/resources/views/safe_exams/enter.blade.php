@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-4">
            @if($seb_session)
                <a class="btn btn-success d-block py-5 mb-5"
                   href="{{ $safe_exam->url }}">{{ __('Click here to open the application') }}</a>
                <a class="btn btn-danger d-block"
                   href="{{ $sebs_exit_url }}">{{ __('Click here to exit Safe Exam Browser') }}</a>
            @else
                <a class="btn btn-primary d-block py-5"
                   href="{{ $sebs_url }}">{{ __('Click here to open Safe Exam Browser') }}</a>
            @endif
        </div>
    </div>

@endsection
