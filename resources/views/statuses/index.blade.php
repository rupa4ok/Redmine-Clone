@extends('layouts.app')

@section('content')
    <div class="container card">
        <div class="row justify-content-center mb-5 card-header">
            <div class="list-group">
                <a href="{{ route('statuses.create') }}"
                   class="list-group-item list-group-item-action list-group-item-info">Create new Status</a>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($statuses as $status)
                <div class="col-sm-3 mb-4">
                    <div class="card">
                        <div class="card-body pl-0 pr-0 pb-0">
                            <div class="h5 card-title text-center">#{{ $status->id }}</div>
                            <p class="card-text h5 text-center"><strong>{{ $status->name }}</strong></p>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('statuses.show', $status->id) }}"
                                           class="btn btn-primary">Show</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('statuses.edit', $status->id) }}"
                                           class="btn btn-warning">Edit</a>
                                    </div>
                                    <div>
                                        <form action="{{route('statuses.destroy', $status->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger"
                                                    data-confirm="Are you sure you want to Delete Status?">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center card-footer">
            {{ $statuses->links() }}
        </div>
    </div>
@endsection
