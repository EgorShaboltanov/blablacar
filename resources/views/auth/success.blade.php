@extends('layouts.main')
@section('content')
<div class="container text-center">
    <h1 class="h3">Вы успешно зарегистрировались</h1>
    <p>Теперь вы можете войти в свой аккаунт.</p>
    <a href="{{ route('login') }}" class="btn btn-primary btn-sm rounded-pill">Войти</a> 
</div>
@endsection
