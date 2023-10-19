@extends('layouts.main')
@section('content')
<div class="container text-center">
    <h1 class="h3">Введите ФИО</h1>
        <form  method="post" action="{{ route('name') }}" > 
        @csrf
        <div class="input-group mb-3 w-50 mx-auto">
            <input class="form-control" name="name" placeholder="ФИО..." autocorrect="off" value="{{ old('name') }}">
        </div>
        @error('name')
            <div class="alert alert-danger my-2 col-6 mx-auto">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="btn btn-primary btn-sm rounded-pill">Отправить</button>
    </form>

    @if (session('message'))
    <div class="alert alert-info my-2 col-6 mx-auto">
        {{ session('message') }}
    </div>
@endif
</div>
@endsection
