@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">
    <a href="{{ route('questions') }}">Questions</a> / 
    Question #{{ $question->id }}
    </h1>
    <hr>
    <p class="mb-4">Author: {{ $question->user->name }}</p>
    <h5 class="mb-4">{{ $question->text }}</h5>
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Variant</th>
                <th>Answers</th>
            </tr>
            @foreach($question->variants as $key => $variant)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $variant->text }}</td>
                <td>
                    @forelse($variant->answers as $answer)
                    <div>{{ $answer->user->name }}</div>
                    @empty
                    <small class="text-muted">Пока никто</small>
                    @endforelse
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
