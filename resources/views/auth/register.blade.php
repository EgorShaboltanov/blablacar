@extends('layouts.main')
@section('content')
<div class="container text-center">
    <form class="oneAction">
        <h1 class="h3">Как вы хотите зарегистрироваться?</h1>
        <div class="col-6 mx-auto my-1 p-1 border border-secondary rounded">
            <a href="#" class="registration-option" data-provider="Вконтакте" style="text-decoration: none;">Через Вконтакте</a>
        </div>
        <div class="dropdown-divider"></div>
        <div class="col-6 mx-auto my-1 p-1 border border-secondary rounded">
            <a href="{{ route('email') }}" class="registration-option" style="text-decoration: none;">Через эл. почту</a>
        </div>
        
        
        <p>Уже зарегистрированы? <a href="{{ route('login') }}" style="text-decoration: none;">Вход</a></p>
        <div class="text-muted small my-1" style="margin: 20%;" >
            Регистрируясь, вы принимаете <a href="https://blog.blablacar.ru/about-us/terms-and-conditions" target="_blank" class="text-muted small">Условия использования</a> и <a href="https://blog.blablacar.ru/about-us/privacy-policy" target="_blank" class="text-muted small">Политику конфиденциальности</a>.
            ООО "Комьюто Рус" собирает эту информацию с целью создания вашей учетной записи, обработки бронирований, а также для улучшения своих услуг и обеспечения безопасности своей платформы.
            У вас есть права в отношении ваших персональных данных, и вы можете ими воспользоваться. Для этого необходимо <a href="/contact" class="text-muted small">связаться</a> с BlaBlaCar. <a href="https://blog.blablacar.ru/about-us/privacy-policy" target="_blank" class="text-muted small">Политика конфиденциальности</a> содержит подробное описание ваших прав и порядок обработки персональных данных.
        </div>
    </form>
</div>
@endsection
