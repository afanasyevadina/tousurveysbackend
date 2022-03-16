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
                    @can('admin')
                        <th></th>
                    @endcan
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
                        @can('admin')
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#delete-{{ $question->id }}">Delete</a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    @can('admin')
        @foreach($questions as $question)
            <div class="modal fade" tabindex="-1" id="delete-{{ $question->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('questions.delete', $question->id) }}" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>This question will be deleted</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-light">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endcan
@endsection
