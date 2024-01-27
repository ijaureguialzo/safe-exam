@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Edit classroom'), 'subtitulo' => ''])

    <form action="{{ route('safe_exams.update', [$safe_exam->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <label class="col-2 form-label" for="classroom">{{ __('Classroom') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="classroom" name="classroom"
                       value="{{ $safe_exam->classroom }}"/>
                <span class="text-danger">{{ $errors->first('classroom') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="url">{{ __('URL') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="url" name="url" value="{{ $safe_exam->url }}"/>
                <span class="text-danger">{{ $errors->first('url') }}</span>
            </div>
        </div>
        <div class="mt-5">
            <input class="btn btn-primary" type="submit" name="guardar" value="{{ __('Save') }}"/>
            <a class="btn btn-link link-secondary link-underline-opacity-0 link-underline-opacity-100-hover ms-2"
               href="{{ route('safe_exams.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>

@endsection
