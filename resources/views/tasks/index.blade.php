@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="list-group">
                <a href="{{ route('statuses.create') }}"
                   class="list-group-item list-group-item-action list-group-item-info">Create new Status</a>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($tasks as $task)
                <div class="col-sm-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="h5 card-title text-center">#{{ $task->id }}</div>
                            <p class="card-text h5 text-center"><strong>{{ $task->name }}</strong></p>
                            <div class="d-flex justify-content-around">
                                <a href="{{ route('statuses.show', $task->id) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('statuses.edit', $task->id) }}"
                                   class="btn btn-warning mr-4">Edit</a>
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
            @endforeach
        </div>
        <div class="row justify-content-center">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
