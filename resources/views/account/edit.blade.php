@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container card">
            <div class="card-body d-flex justify-content-center align-content-center">
                <form action="{{ route('account.update') }}">
                    <div class="form-inline form-group">
                        <label for="inputName" class="">Name</label>
                        <input type="text" id="inputName" class="form-control" name="name">
                    </div>

                    <div class="form-inline form-group">
                        <label for="inputName" class="">Email</label>
                        <input type="email" id="inputEmail" class="form-control" name="email">
                    </div>

                    <div>
                        <button type="submit" class="btn">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
