@extends('layout.dashboard')

@section('body')

<div class="row clearfix">
    <div class="col-md-4 column">
    </div>
    <div class="col-md-4 column">

        <form method="POST" action="/auth/password/reset">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="new password">
            </div>
            <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm password">
            </div>
            <button type="submit" class="btn btn-default">
                Set new password
            </button>
        </form>
    </div>
    <div class="col-md-4 column">
    </div>
</div>

@endsection