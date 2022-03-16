@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-body h4">
                Hello, {{ auth()->user()->name }}, today we already have:
            </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <div class="h1">{{ $users }}</div>
                        <div class="h4">users</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <div class="h1">{{ $questions }}</div>
                        <div class="h4">questions</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <div class="h1">{{ $answers }}</div>
                        <div class="h4">answers</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
