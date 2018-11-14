@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card w-100">
                <div class="h5 card-header">Tag #{{$status->id}}</div>
                <div class="card-body pr-5 pl-5">
                    <div class="h5 card-title"><strong>{{ $status->name }}</strong></div>
                    <div class="list-group mb-2">
                        <button type="button" class="list-group-item list-group-item-action"><strong>Task Created
                                At:</strong> {{ $status->created_at }}</button>
                        <button type="button" class="list-group-item list-group-item-action"><strong>TaskUpdated
                                At:</strong> {{ $status->updated_at }}</button>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{ route('statuses.edit', $status->id) }}" class="btn btn-warning mr-4">Edit</a>
                        <form action="{{route('statuses.destroy', $status->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger"
                                    data-confirm="Are you sure you want to submit?">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection