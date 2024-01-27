@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Welcome'), 'subtitulo' => ''])

    <a href="#">Click here to open Safe Exam Browser</a>

@endsection
