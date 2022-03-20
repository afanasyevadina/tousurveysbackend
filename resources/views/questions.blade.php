@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1>Questions</h1>
            <form action="{{ route('questions.mass-delete') }}" method="POST" id="mass-delete" hidden>
                @csrf
                <button class="btn btn-primary">Удалить выбранные</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    @can('admin')
                        <th>
                            <input type="checkbox" id="select-all">
                        </th>
                    @endcan
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
                        @can('admin')
                            <td>
                                <input type="checkbox" name="ids[]" form="mass-delete" value="{{ $question->id }}">
                            </td>
                        @endcan
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
@section('scripts')
    @can('admin')
        <script>
            const checkers = document.querySelectorAll('[name="ids[]"]')
            const toggleBtn = () => document.getElementById('mass-delete').hidden = Array.from(checkers).filter(v => v.checked).length == 0
            checkers.forEach(check => {
                check.onchange = toggleBtn
            })

            document.getElementById('select-all').onchange = e => {
                checkers.forEach(check => check.checked = e.target.checked)
                toggleBtn()
            }
        </script>
    @endcan
@endsection
