@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card w-100">
                <div class="h5 card-header">Task #{{$task->id}}</div>
                <div class="card-body border">
                    <div class="h5 card-title"><strong> {{ $task->name }}</strong> <span
                                class="badge badge-info"> {{ $status->name }} </span></div>
                    <div class="card-text mb-2"><strong>Description:</strong> {{ $task->description }}</div>

                    <div class="list-group mb-2">
                        <button type="button" class="list-group-item list-group-item-action"><strong>Executor
                                Name:</strong> {{ $executor->name }}</button>
                        <button type="button" class="list-group-item list-group-item-action"><strong>Executor
                                Email:</strong> {{ $executor->email }}</button>
                        <button type="button" class="list-group-item list-group-item-action"><strong>Creator
                                Name:</strong> {{ $creator->name }}</button>
                        <button type="button" class="list-group-item list-group-item-action"><strong>Executor
                                Email:</strong> {{ $creator->email }}</button>
                        <button type="button" class="list-group-item list-group-item-action"><strong>Task Created
                                At:</strong> {{ $task->created_at }}</button>
                        <button type="button" class="list-group-item list-group-item-action"><strong>TaskUpdated
                                At:</strong> {{ $task->updated_at }}</button>
                    </div>
                    @foreach($tags as $tag)
                        <span class="badge badge-info">{{ $tag->name }}</span>
                    @endforeach
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