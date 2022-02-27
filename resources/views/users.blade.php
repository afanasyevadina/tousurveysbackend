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
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
