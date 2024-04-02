@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Allowed apps and URLs'), 'subtitulo' => $safe_exam->classroom])

    <h2>Allowed apps</h2>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
            <tr class="table-dark">
                <th>{{ __('Title') }}</th>
                <th>{{ __('Executable') }}</th>
                <th>{{ __('Path') }}</th>
                <th>{{ __('Show icon') }}</th>
                <th>{{ __('Force close') }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($safe_exam->allowed_apps as $allowed_app)
                <tr>
                    <td>{{ $allowed_app->title }}</td>
                    <td>{{ $allowed_app->executable }}</td>
                    <td>{{ $allowed_app->path }}</td>
                    <td>{{ $allowed_app->show_icon ? __('Yes') : __('No') }}</td>
                    <td>{{ $allowed_app->force_close ? __('Yes') : __('No') }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('allowed_apps.edit', [$allowed_app->id]) }}"
                               title="{{ __('Edit allowed app') }}"
                               class="btn btn-sm btn-secondary me-2" role="button">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('allowed_apps.duplicate', [$allowed_app->id]) }}" method="POST">
                                @csrf
                                <button title="{{ __('Duplicate allowed app') }}"
                                        name="duplicate_allowed_app"
                                        type="submit"
                                        class="btn btn-sm btn-secondary me-2">
                                    <i class="bi bi-copy"></i>
                                </button>
                            </form>
                            <form action="{{ route('allowed_apps.destroy', [$allowed_app->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button title="{{ __('Delete allowed app') }}"
                                        name="delete_classroom"
                                        type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                                        class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <a href="{{ route('allowed_apps.create', [$safe_exam->id]) }}"
           class="btn btn-primary" role="button">
            {{ __('New allowed app') }}
        </a>
    </div>

    <h2 class="mt-5">Allowed URLs</h2>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
            <tr class="table-dark">
                <th>{{ __('URL') }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($safe_exam->allowed_urls as $allowed_url)
                <tr>
                    <td>{{ $allowed_url->url }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('allowed_urls.edit', [$allowed_url->id]) }}"
                               title="{{ __('Edit allowed URL') }}"
                               class="btn btn-sm btn-secondary me-2" role="button">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('allowed_urls.duplicate', [$allowed_url->id]) }}" method="POST">
                                @csrf
                                <button title="{{ __('Duplicate allowed URL') }}"
                                        name="duplicate_allowed_url"
                                        type="submit"
                                        class="btn btn-sm btn-secondary me-2">
                                    <i class="bi bi-copy"></i>
                                </button>
                            </form>
                            <form action="{{ route('allowed_urls.destroy', [$allowed_url->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button title="{{ __('Delete allowed URL') }}"
                                        name="delete_classroom"
                                        type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                                        class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <a href="{{ route('allowed_urls.create', [$safe_exam->id]) }}"
           class="btn btn-primary" role="button">
            {{ __('New allowed URL') }}
        </a>
    </div>

    <div class="mt-5">
        <a class="btn btn-secondary" href="{{ route('safe_exams.index') }}">{{ __('Back') }}</a>
    </div>
@endsection
