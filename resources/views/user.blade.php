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
                    @forelse($user->questions as $question)
                    <a href="{{ route('question', $question->id) }}">{{ $question->text }}</a>
                    @empty
                    <div class="text-muted">Пока нет вопросов</div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Ответы</h4>
                    @forelse($user->answers as $answer)
                    <a href="{{ route('question', $answer->question->id) }}">{{ $answer->question->text }}</a> - {{ $answer->variant->text }}
                    @empty
                    <div class="text-muted">Пока нет ответов</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
