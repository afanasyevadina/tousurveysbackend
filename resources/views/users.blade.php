@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Users</h1>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Questions created</th>
                    <th>Answers count</th>
                    @can('admin')
                        <th></th>
                    @endcan
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <a href="{{ route('user', $user->id) }}">{{ $user->name }}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->questions_count }}</td>
                        <td>{{ $user->answers_count }}</td>
                        @can('admin')
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#delete-{{ $user->id }}">Delete</a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    @can('admin')
        @foreach($users as $user)
            <div class="modal fade" tabindex="-1" id="delete-{{ $user->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('users.delete', $user->id) }}" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>This user will be deleted</p>
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
