@extends('layouts.app')

@section('title', 'User Login')

@section('content')

<form action="{{ route('login') }}" method="POST">
    @csrf

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
        <input required class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
            name="password" placeholder="Password">
        @if($errors->has('password'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <div class="form-check">
            <input id="remember" type="checkbox" class="form-check-input" name="remember"
                value="{{ old('remember') ? 'checked' : '' }}">
            <label class="form-check-label" for="remember">Remember Me</label>

        </div>
    </div>

    <div>
        <input class="btn btn-primary btn-block" type="submit" value="Login">
    </div>

</form>

@endsection