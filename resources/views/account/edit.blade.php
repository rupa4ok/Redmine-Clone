@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">{{ __('Update Email and Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('account.update') }}" aria-label="Update">
                            @method('PUT')
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ $user->name }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="account_update">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('password.email') }}" aria-label="reset">
                            @csrf
                            <div class="form-group row">
                                <label for="reset"
                                       class="col-sm-4 col-form-label text-md-right">{{ $user->email }}</label>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-warning" id="reset">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb">
                    <div class="card-header">{{ __('Delete Account') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('account.destroy') }}">
                            @method('DELETE')
                            @csrf
                            <div class="form-group row">
                                <label for="delete"
                                       class="col-sm-4 col-form-label text-md-right">{{ $user->name }}</label>
                                <div class="col-md-6">
                                    <button id="delete" type="submit" class="btn btn-danger"
                                            data-confirm="Are you sure you want to Delete Account?">
                                        {{ __('Delete This Account') }}
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
