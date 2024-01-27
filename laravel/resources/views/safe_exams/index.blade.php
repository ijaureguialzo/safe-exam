@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Your safe exam classrooms'), 'subtitulo' => ''])

    <div>
        <table class="table align-middle">
            <thead>
            <tr>
                <th colspan="2">{{ __('Classroom') }}</th>
                <th colspan="2">{{ __('URL') }}</th>
                <th colspan="2">{{ __('Token') }}</th>
                <th colspan="2">{{ __('Quit password') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($safe_exams as $safe_exam)
                <tr>
                    <td>{{ $safe_exam->classroom }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="#"
                               title="{{ __('Edit classroom') }}"
                               class="btn btn-sm btn-secondary" role="button">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>
                    </td>
                    <td>{{ $safe_exam->url }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="#"
                               title="{{ __('Edit URL') }}"
                               class="btn btn-sm btn-secondary" role="button">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>
                    </td>
                    <td>{{ $safe_exam->token ?: '-' }}</td>
                    <td>
                        <div class="btn-group">
                            <form action="{{ route('safe_exams.reset_token', [$safe_exam->id]) }}" method="POST">
                                @csrf
                                <button title="{{ __('Reset token') }}"
                                        name="reset_token"
                                        type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                                        class="btn btn-sm btn-primary me-2">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </form>
                            <form action="{{ route('safe_exams.delete_token', [$safe_exam->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button title="{{ __('Delete token') }}"
                                        name="delete_token"
                                        type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                                        class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>{{ $safe_exam->quit_password ?: '-' }}</td>
                    <td>
                        <div class="btn-group">
                            <form action="{{ route('safe_exams.reset_quit_password', [$safe_exam->id]) }}"
                                  method="POST">
                                @csrf
                                <button title="{{ __('Reset quit password') }}"
                                        name="reset_quit_password"
                                        type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                                        class="btn btn-sm btn-primary me-2">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </form>
                            <form action="{{ route('safe_exams.delete_quit_password', [$safe_exam->id]) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button title="{{ __('Delete quit password') }}"
                                        name="delete_quit_password"
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
@endsection
