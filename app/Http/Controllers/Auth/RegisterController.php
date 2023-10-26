<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    function showRegistrationForm(){
        return view('auth.register');
    }

    public function emailStore(Request $request)
{

    $validated = $request->validate([
        'email' => ['required', 'email']
    ]);

    $email = $validated['email'];

    $users = User::where('email', $email)->get();

    if ($users->count() > 0) {
        // Пользователи с такой почтой существуют
        return redirect()->back()->with('message', 'Пользователь с таким email уже существует!');
        
    } else {
        // Пользователей с такой почтой не найдено
        // Ваши действия при отсутствии пользователей
        session(['registration_email' => $email]);
        return redirect()->route('name');
        
    }
}


    public function nameStore(Request $request){


        $validated = $request->validate([
            'name' => ['required', 'regex:/^[\p{Cyrillic}\s]+$/u', 'max:70'],
        ]);

        $name = $validated['name'];
        session(['registration_name' => $name]);

        return redirect()->route('dateBirth');

        // dump($validated);
        // dump(session('registration_name'));

    }

    public function dateBirthStore(Request $request){

        $validated = $request->validate([
            'dateBirth' => ['required','date'],
        ]);

        $dateBirth = $validated['dateBirth'];
        session(['registration_dateBirth' => $dateBirth]);

        return redirect()->route('gender');

        // dump($validated);
        // dump(session('registration_name'));

    }

    public function genderStore(Request $request)
{
    $validated = $request->validate([
        'gender' => ['required', 'in:male,female,other'],
    ]);

    $gender = $validated['gender'];
    session(['registration_gender' => $gender]);

    return redirect()->route('password');
}



    public function passwordStore(Request $request) {
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'password_regex:/^[a-zA-Z0-9]+$/'],
        ]);
        
        $password = $validated['password'];
        session(['registration_password' => $password]);
    
    
        return redirect()->route('numberPhone');
    }

    public function phoneNumberAndRegistrationStore(Request $request) {
        $validated = $request->validate([
            'phoneNumber' => ['required', 'string', 'phone_regex:/^\+7[0-9]{10}$/'],
        ]);
        
        $phoneNumber = $validated['phoneNumber'];
        session(['registration_phoneNumber' => $phoneNumber]);
    
        $name = session('registration_name');
        $email = session('registration_email');
        $dateBirth = session('registration_dateBirth');
        $gender = session('registration_gender');
        $password = session('registration_password');
    
        // Создание нового пользователя
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password); // Хеширование пароля перед сохранением
        $user->date_of_birth = $dateBirth;
        $user->gender = $gender;
        $user->phone_number = $phoneNumber;
    
        $user->save();
    
        // В этой точке регистрация завершена
    
        //Очистить сессию от временных данных
        session()->forget('registration_name');
        session()->forget('registration_email');
        session()->forget('registration_password');
        session()->forget('registration_dateBirth');
        session()->forget('registration_gender');
        session()->forget('registration_phoneNumber');

    
        // Далее, вы можете выполнить дополнительные действия, например, авторизовать пользователя и перенаправить его
    
        // Перенаправление пользователя, как вам нужно
        return redirect()->route('success');
    }
    
    function successRegistration(){
        return view('auth.success');
    }

}
