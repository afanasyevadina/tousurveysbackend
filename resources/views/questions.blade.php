@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Questions</h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Text</th>
                <th>Author</th>
                <th>Variants count</th>
                <th>Answers count</th>
            </tr>
            @foreach($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>
                    <a href="{{ route('question', $question->id) }}">
                        {{ $question->text }}
                    </a>
                </td>
                <td>{{ $question->user->name }}</td>
                <td>{{ $question->variants_count }}</td>
                <td>{{ $question->answers_count }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
