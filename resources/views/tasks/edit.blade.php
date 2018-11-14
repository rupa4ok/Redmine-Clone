@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Task name') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ $task->name }}" required>

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
                                    <textarea id="description"
                                              class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                              name="description" required>{{ $task->description }}</textarea>

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
                                    <option value="{{$status->id}}" selected>{{$status->name}}</option>
                                    @foreach($freeStatuses as $freeStatus)
                                        <option value="{{$freeStatus->id}}">{{$freeStatus->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="executor">{{ __('Executor') }}</label>
                                </div>
                                <select class="custom-select custom-select-lg" name="executor_id" size="1"
                                        id="executor">
                                    <option value="{{$executor->id}}" selected>{{$executor->name}}</option>
                                    @foreach($freeUsers as $freeUser)
                                        <option value="{{$freeUser->id}}">{{$freeUser->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="tag_from">{{ __('Tags') }}</label>
                                </div>
                                <select id="tag_from" class="form-control" multiple="multiple" name="tags[]" size="1">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" selected> {{ $tag->name }} </option>
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
                                    <button type="submit" class="btn btn-warning"
                                            data-confirm="Are you sure you want to save?">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
