@extends('layouts.app')

@section('title', 'User Registration')

@section('content')

<form action="{{ route('register') }}" method="POST">
    @csrf

    <div class="form-group">
        <input required class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name"
            value="{{ old('name', optional($post ?? null)->name) }}" placeholder="Name">
        @if($errors->has('name'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <input required class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email"
            value="{{ old('email', optional($post ?? null)->email) }}" placeholder="Email">
        @if($errors->has('email'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <input required class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" type="text" name="phone_number"
            value="{{ old('phone_number', optional($post ?? null)->email) }}" placeholder="Phone Number">
        @if($errors->has('phone_number'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('phone_number') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <input required class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
            name="password" placeholder="Password">
        @if($errors->has('password'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <input required class="form-control" type="password" name="password_confirmation" placeholder="Retype Password">
    </div>

    <div>
        <input class="btn btn-primary btn-block" type="submit" value="Register">
    </div>

</form>

@endsection