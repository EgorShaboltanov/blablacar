@extends('layouts.main')
@section('content')
<div class="container text-center">
    <h1 class="h3">Подтвердите номер телефона</h1>
    <form method="post" action="{{ route('numberPhone') }}">
        @csrf
        <div class="input-group mb-3 w-50 mx-auto">
            <input type="tel" class="form-control" name="phoneNumber" placeholder="Номер телефона.." autocorrect="off" value="{{ old('phoneNumber') }}">
        </div>
        @error('phoneNumber')
            <div class="alert alert-danger my-2 col-6 mx-auto">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary btn-sm rounded-pill">Отправить</button>
    </form>


    {{-- {{session('registration_name')}}
    {{session('registration_email')}}
    {{session('registration_dateBirth')}}
    {{session('registration_gender')}}
    {{session('registration_password')}}
    {{session('registration_phoneNumber')}} --}}

    @if (session('message'))
    <div class="alert alert-info my-2 col-6 mx-auto">
        {{ session('message') }}
    </div>
    @endif
</div>

@endsection
