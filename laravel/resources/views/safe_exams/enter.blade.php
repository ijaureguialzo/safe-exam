@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Welcome'), 'subtitulo' => ''])

    <a class="btn btn-primary" href="{{ $sebs_url }}">Click here to open Safe Exam Browser</a>
    <a class="btn btn-danger" href="{{ $sebs_exit_url }}">Click here to exit Safe Exam Browser</a>

@endsection
