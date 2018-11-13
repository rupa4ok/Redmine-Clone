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
            @foreach($statuses as $status)
                <div class="col-sm-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="h5 card-title text-center">#{{ $status->id }}</div>
                            <p class="card-text h5 text-center"><strong>{{ $status->name }}</strong></p>
                            <div class="d-flex justify-content-around">
                                <a href="{{ route('statuses.show', $status->id) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('statuses.edit', $status->id) }}"
                                   class="btn btn-warning mr-4">Edit</a>
                                <form action="{{route('statuses.destroy', $status->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"  data-confirm="Are you sure you want to submit?">
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
            {{ $statuses->links() }}
        </div>
    </div>
@endsection
