@extends('layouts.main')
@section('content')
<div class="container text-center">
    <h1 class="h3">Адрес эл.почты и пароль?</h1>
    <form method="post" action="{{ route('loginEmail') }}">
        @csrf
        <div class="input-group mb-3 w-50 mx-auto">
            <input class="form-control" name="email" placeholder="Почта..." autocorrect="off" value="{{ old('email') }}">
        </div>
        @error('email')
            <div class="alert alert-danger my-2 col-6 mx-auto">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3 w-50 mx-auto">
            <input class="form-control" name="password" placeholder="Пароль..." autocorrect="off" value="{{ old('password') }}">
        </div>

        @error('password')
        <div class="alert alert-danger my-2 col-6 mx-auto">{{ $message }}</div>
        @enderror        
        <button type="submit" class="btn btn-primary btn-sm rounded-pill">Войти</button>
    </form>

</div>
@endsection
