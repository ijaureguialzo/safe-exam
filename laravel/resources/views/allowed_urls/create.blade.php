@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('New allowed URL'), 'subtitulo' => ''])

    <form action="{{ route('allowed_urls.store') }}" method="POST">
        @csrf
        <input type="hidden" id="safe_exam_id" name="safe_exam_id" value="{{ $safe_exam->id }}"/>
        <div class="row mb-3">
            <label class="col-2 col-form-label" for="url">{{ __('URL') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="url" name="url"
                       placeholder="https://wikipedia.org" value="{{ old('url') }}"/>
                <span class="text-danger">{{ $errors->first('url') }}</span>
            </div>
        </div>
        <div class="mt-5">
            <input class="btn btn-primary" type="submit" name="guardar" value="{{ __('Save') }}"/>
            <a class="btn btn-link link-secondary link-underline-opacity-0 link-underline-opacity-100-hover ms-2"
               href="{{ route('safe_exams.allowed', [$safe_exam->id]) }}">{{ __('Cancel') }}</a>
        </div>
    </form>

@endsection
