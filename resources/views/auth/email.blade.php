@extends('layouts.main')
@section('content')
<div class="container text-center">
    <h1 class="h3">Введите эл. почту</h1>
    <form method="post" action="{{ route('email') }}">
        @csrf
        <div class="input-group mb-3 w-50 mx-auto">
            <input class="form-control" name="email" placeholder="Почта..." autocorrect="off" value="{{ old('email') }}">
        </div>
        @error('email')
            <div class="alert alert-danger my-2 col-6 mx-auto">{{ $message }}</div>
        @enderror

        @if (session('message'))
            <div class="alert alert-info my-2 col-6 mx-auto">
                {{ session('message') }}
            </div>
        @endif
        
        <button type="submit" class="btn btn-primary btn-sm rounded-pill">Отправить</button>
    </form>

    
</div>
@endsection
