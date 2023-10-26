@extends('layouts.main')
@section('content')
<div class="container text-center">
    <h1 class="h3">Пожалуйста, укажите свой пол</h1>
    <form method="post" action="{{ route('gender') }}">
        @csrf

        <div class="mb-3 row">
            <div class="col-3"></div>
            <div class="col-6">
                <input type="radio" class="btn-check" name="gender" id="male" autocomplete="off" value="male">
                <label for="male" style="width: 100%;" class="btn btn-outline-secondary">Мужской</label>
            </div>
            <div class="col-3"></div>
        </div>
        
        <div class="mb-3 row">
            <div class="col-3"></div>
            <div class="col-6">
                <input type="radio" class="btn-check" name="gender" id="female" autocomplete="off" value="female">
                <label for="female" style="width: 100%;" class="btn btn-outline-secondary">Женский</label>
            </div>
            <div class="col-3"></div>
        </div>
        
        <div class="mb-3 row">
            <div class="col-3"></div>
            <div class="col-6">
                <input type="radio" class="btn-check" name="gender" id="other" autocomplete="off" value="other">
                <label for="other" style="width: 100%;" class="btn btn-outline-secondary">Предпочитаю не указывать пол</label>
            </div>
            <div class="col-3"></div>
        </div>
        
        
        @error('gender')
            <div class="alert alert-danger my-2 col-6 mx-auto">{{ $message }}</div>
        @enderror
        
        
        <button type="submit" class="btn btn-primary btn-sm rounded-pill">Отправить</button>
    </form>

    {{session('registration_gender')}}
    @if (session('message'))
        <div class="alert alert-info my-2 col-6 mx-auto">
            {{ session('message') }}
        </div>
    @endif
</div>
@endsection
