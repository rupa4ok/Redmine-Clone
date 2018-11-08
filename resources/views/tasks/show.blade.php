@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card w-100">
                <div class="h5 card-header">Tag #{{$task->id}}</div>
                <div class="card-body border border-info">
                    <div class="h5 card-title"><strong>{{ $task->description }}</strong></div>
                    <div class="h5 card-title"><strong>{{ $status->name }}</strong></div>
                    <div class="h5 card-title"><strong>{{ $executor->name }}</strong></div>
                    <div class="h5 card-title"><strong>{{ $executor->email }}</strong></div>
                    <div class="h5 card-title"><strong>{{ $task->created_at }}</strong></div>
                </div>
                <div class="d-flex card-footer text-muted">
                    <a href="{{ route('statuses.edit', $task->id) }}" class="btn btn-warning mr-4">Edit</a>
                    <form action="{{route('statuses.destroy', $task->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection