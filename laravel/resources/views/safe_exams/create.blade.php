@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('New classroom'), 'subtitulo' => ''])

    <form action="{{ route('safe_exams.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <label class="col-2 form-label" for="classroom">{{ __('Classroom') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="classroom" name="classroom" placeholder="test"
                       value="{{ old('classroom') }}"/>
                <span class="text-danger">{{ $errors->first('classroom') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="url">{{ __('URL') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="url" name="url"
                       placeholder="https://api.socrative.comm/fake/123456" value="{{ old('url') }}"/>
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
