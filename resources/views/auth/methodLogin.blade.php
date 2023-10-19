@extends('layouts.main')
@section('content')
<div class="container text-center">
    <form class="oneAction">
        <h1 class="h3">Как вы хотите войти?</h1>
        <div class="col-6 mx-auto my-1 p-1 border border-secondary rounded">
            <a href="#" class="registration-option" data-provider="Вконтакте" style="text-decoration: none;">Войти через Вконтакте</a>
        </div>
        <div class="col-6 mx-auto my-1 p-1 border border-secondary rounded">
            <a href="#" class="registration-option" data-provider="Фейсбук" style="text-decoration: none;">Войти через Facebook</a>
        </div>
        <div class="dropdown-divider"></div>
        <div class="col-6 mx-auto p-1 border border-secondary rounded">
            <a href="{{ route('loginEmail') }}" class="registration-option" style="text-decoration: none;">Через эл. почту</a>
        </div>
        
        
        <p>Ещё не с нами? <a href="{{ route('register') }}" style="text-decoration: none;">Зарегистрироваться</a></p>
    </form>
</div>
@endsection
