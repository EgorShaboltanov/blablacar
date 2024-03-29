<?php
return [
    'required' => 'Поле :attribute обязательно для заполнения.',
    'email' => 'Поле :attribute должно быть действительным адресом электронной почты.',
    'string' => 'Поле :attribute должно содержать текст.',
    'regex' => 'Поле :attribute должно содержать только кириллические буквы.',
    'max' => [
        'string' => 'Поле :attribute не должно превышать 70 символов.',
    ],
    'min' => [
        'string' => 'Поле :attribute должно быть не меньше 8 символов.',
    ],
    
    'password_regex' => 'Поле :attribute должно содержать только латинские буквы и цифры.',
    'phone_regex' => 'Поле :attribute должно быть в формате +7XXXXXXXXXX, где X - цифра.',
    'date' => 'Поле :attribute должно содержать настоящую дату рождения!'
];
