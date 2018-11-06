@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="h5 card-header">Tag #{{$taskStatus->id}}</div>
                <div class="card-body pr-5 pl-5">
                    <div class="h5 card-title"><strong>{{ $taskStatus->name }}</strong></div>
                    <div class="d-flex">
                        <a href="{{ route('statuses.edit', $taskStatus->id) }}" class="btn btn-warning mr-4">Edit</a>
                        <form action="{{route('statuses.destroy', $taskStatus->id)}}" method="POST">
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
    </div>
@endsection