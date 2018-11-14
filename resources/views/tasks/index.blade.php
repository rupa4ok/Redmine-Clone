@extends('layouts.app')

@section('content')
    <div class="container card border-dark pl-0 pr-0">
        <div class="card-header">
            <form method="GET" action="{{ route('tasks.index') }}">
                @method('GET')
                <div class="row justify-content-center mb-5">
                    <div class="list-group">
                        <a href="{{ route('tasks.create') }}"
                           class="list-group-item list-group-item-action list-group-item-info">Create new Task</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="executor_select">Executors</span>
                            </div>
                            <select class="form-control custom-select" id="executor_select" name="executor_id" size="1">
                                @foreach($executors as $executor)
                                    <option value="{{$executor->id}}">{{$executor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="status_select">Status</span>
                            </div>
                            <select class="form-control custom-select" id="status_select" name="status_id" size="1">
                                @foreach($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="tags_select">Tags</span>
                            </div>
                            <select id="tags_select" class="form-control custom-select" name="tags[]" size="1">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend ">
                                <label class="input-group-text">Assigned to me</label>
                            </div>
                            <div class="input-group-append">
                                <div class="input-group-text bg-light">
                                    <input type="checkbox" name="my">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-info">Filter</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group d-flex justify-content-center">
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row justify-content-center card-body">
            @foreach($tasks as $task)
                <div class="col-sm-3 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="h5 card-title d-flex text-center flex-column">
                                <div>#{{$task->id}}</div>
                                <div><strong>{{ $task->name }}</strong></div>
                                <div><span
                                            class="badge badge-info"> {{ $task->status->name }} </span></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text"> {{ str_limit($task->description, 75) }}</p>
                            <div class="list-group mb-2">
                                <button type="button" class="list-group-item list-group-item-action"><strong>Executor
                                        Name:</strong> {{ $task->executor->name }}</button>
                                <button type="button" class="list-group-item list-group-item-action"><strong>Updated
                                        Time:
                                    </strong> {{ $task->updated_at->format('d/m/Y') }}</button>
                                @foreach($task->tags as $tag)
                                    <span class="badge badge-dark mb-1">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary">Show</a>
                                </div>
                                <div>
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                       class="btn btn-warning">Edit</a>
                                </div>
                                <div>
                                    <form action="{{route('tasks.destroy', $task->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger"
                                                data-confirm="Are you sure you want to Delete Task?">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center card-footer">
            {{ $tasks->links() }}
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#tag_from').select2({
                tokenSeparators: [",", " "],
                placeholder: 'Choose a tag...',
                tags: true,
            });
        });
    </script>
@endsection
