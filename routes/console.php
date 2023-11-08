<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('botInfo', function(){


$bot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);
dump($bot->info());

});


Artisan::command('chatInfo', function () {

$chats = \DefStudio\Telegraph\Models\TelegraphChat::all();

foreach($chats as $chat){
    dump($chat->info());
}

});



Artisan::command('menuBot', function(){
    /** @var \DefStudio\Telegraph\Models\TelegraphBot $telegraphBot */

    $bot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);

    dump($bot->registerCommands([
        '/start' => 'Начать работу с ботом',
        '/actions' => 'Различные действия',
        '/weather' => 'Узнать погоду в вашем городе',
    ]))->send();
    });