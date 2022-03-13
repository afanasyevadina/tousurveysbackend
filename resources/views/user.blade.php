@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">
    <a href="{{ route('users') }}">Users</a> / {{ $user->name }}</h1>
    <hr>
    <h5 class="mb-4">Email: {{ $user->email }}</h5>
    <h5 class="mb-4">Registration date: {{ date('d.m.Y', strtotime($user->created_at)) }}</h5>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Вопросы</h4>
                    <ul class="list-group">
                        @forelse($user->questions as $question)
                            <li class="list-group-item">
                                <a href="{{ route('question', $question->id) }}">{{ $question->text }}</a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Пока нет вопросов</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Ответы</h4>
                    <ul class="list-group">
                        @forelse($user->answers as $answer)
                        <li class="list-group-item">
                            <a href="{{ route('question', $answer->question->id) }}">{{ $answer->question->text }}</a> - {{ $answer->variant->text }}
                            </li>
                        @empty
                        <li class="list-group-item text-muted">Пока нет ответов</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
