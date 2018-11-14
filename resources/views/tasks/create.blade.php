@extends('layouts.app')

@section('content')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Task name') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @method('POST')
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea
                                            class="form-control form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                            name="description" required></textarea>

                                    @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="status">{{ __('Status') }}</label>
                                </div>
                                <select class="custom-select custom-select-lg" id="status" name="status_id" size="1">
                                    @foreach($statuses as $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="executor">{{ __('Executor') }}</label>
                                </div>
                                <select class="custom-select custom-select-lg" name="executor_id" size="1"
                                        id="executor">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('executor_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('executor_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="tag_from">{{ __('Tags') }}</label>
                                </div>
                                <select id="tag_from" class="form-control" multiple="multiple" name="tags[]">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tags'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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

