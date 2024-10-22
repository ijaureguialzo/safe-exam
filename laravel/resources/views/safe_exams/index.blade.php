@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Your classrooms'), 'subtitulo' => ''])

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(
                function () {
                    alert("{{ __('Link copied') }}.");
                });
        }
    </script>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
            <tr class="table-dark">
                <th>{{ __('Classroom') }}</th>
                <th colspan="2">{{ __('URL') }}</th>
                <th colspan="2">{{ __('Token') }}</th>
                <th colspan="2">{{ __('Quit password') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($safe_exams as $safe_exam)
                <tr>
                    <td>{{ $safe_exam->classroom }}</td>
                    <td><a class="link-primary link-underline-opacity-0 link-underline-opacity-100-hover"
                           target="_blank" href="{{ $safe_exam->url }}">{{ $safe_exam->url }}</a></td>
                    <td>
                        <div class="d-flex">
                            <button title="{{ __('Copy the safe classroom link to clipboard') }}"
                                    name="copy_link"
                                    type="button"
                                    onclick="copyToClipboard('{{ 'https://' . request()->getHost() . '/classroom/' . $safe_exam->classroom }}')"
                                    class="btn btn-sm btn-primary me-2">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <a href="{{ route('safe_exams.config_seb', [$safe_exam->id]) }}"
                               title="{{ __('Download SEB configuration file') }}"
                               class="btn btn-sm btn-secondary me-2" role="button">
                                <i class="bi bi-download"></i>
                            </a>
                            <a href="{{ route('safe_exams.edit', [$safe_exam->id]) }}"
                               title="{{ __('Edit classroom') }}"
                               class="btn btn-sm btn-secondary me-2" role="button">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ route('safe_exams.allowed', [$safe_exam->id]) }}"
                               title="{{ __('Allowed apps and URLs') }}"
                               class="btn btn-sm btn-secondary me-2" role="button">
                                <i class="bi bi-shield-check"></i>
                            </a>
                            <form action="{{ route('safe_exams.duplicate', [$safe_exam->id]) }}" method="POST">
                                @csrf
                                <button title="{{ __('Duplicate classroom') }}"
                                        name="duplicate_classroom"
                                        type="submit"
                                        class="btn btn-sm btn-secondary me-2">
                                    <i class="bi bi-copy"></i>
                                </button>
                            </form>
                            <form action="{{ route('safe_exams.destroy', [$safe_exam->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button title="{{ __('Delete classroom') }}"
                                        name="delete_classroom"
                                        type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                                        class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>
                        <pre class="m-0">{{ $safe_exam->token ?: '-' }}</pre>
                    </td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('safe_exams.reset_token', [$safe_exam->id]) }}" method="POST">
                                @csrf
                                <button title="{{ __('Reset token') }}"
                                        name="reset_token"
                                        type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                                        class="btn btn-sm btn-danger">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>
                        <pre class="m-0">{{ $safe_exam->quit_password ?: '-' }}</pre>
                    </td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('safe_exams.reset_quit_password', [$safe_exam->id]) }}"
                                  method="POST">
                                @csrf
                                <button title="{{ __('Reset quit password') }}"
                                        name="reset_quit_password"
                                        type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                                        class="btn btn-sm btn-danger">
                                    <i class="bi bi-arrow-clockwise"></i>
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
        <a href="{{ route('safe_exams.create') }}"
           class="btn btn-primary" role="button">
            {{ __('New classroom') }}
        </a>
    </div>

@endsection
