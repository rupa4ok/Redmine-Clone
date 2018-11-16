@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('tasks.index') }}" class="btn btn-lg btn-outline-primary">Tasks</a>
                            </div>
                            <div class="col">
                                <a href="{{ route('statuses.index') }}" class="btn btn-lg btn-outline-info">Statuses</a>
                            </div>
                            <div class="col">
                                <a href="{{ route('members') }}" class="btn btn-lg btn-outline-success">Members</a>
                            </div>
                            <div class="col">
                                <a href="{{ route('account.edit') }}"
                                   class="btn btn-primary btn-lg btn-outline-secondary">Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
