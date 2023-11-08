<?php

namespace App\Telegram;

use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Models\TelegraphChat;

class Handler extends WebhookHandler
{

    public function start(){
        

        // ПРИМЕР РАБОТЫ С POST
        $dataArray = $this->message->toArray();
        $chatId = $dataArray['chat']['id']; // Получаем ID чата из лога
        $token = '6862066323:AAE7DlrHFI-ctA5XvAIcbhEaH9Hx0h5TeME'; // токен моего бота
        $message = 'Добро пожаловать! Я ваш бот. Чем могу помочь?'; // сообщение
        
        // Отправляем запрос к API Telegram
        $response = Http::post("https://api.telegram.org/bot$token/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
        ]);
        
        // Обработка ответа или ошибки отправки
        if ($response->successful()) {
            // Сообщение успешно отправлено
            Log::info('Сообщение успешно отправлено в чат ' . $chatId);
        } else {
            // Ошибка при отправке сообщения
            $error = $response->json(); // Получите информацию об ошибке
            Log::error('Ошибка при отправке сообщения в чат ' . $chatId . ': ' . json_encode($error));
            // Добавьте код для обработки ошибки, если необходимо
        }

    
    }

    public function actions(){


        // ПРИМЕР РАБОТЫ С ПАКЕТОМ TELEGRAPH LARAVEL

        $senderId = $this->message->from()->id(); // Взяли ID чата Telegram
        log::info('chat: ' . $senderId);

        // Получите все чаты из вашей базы данных
        $allChats = TelegraphChat::all();

        foreach ($allChats as $chat) {
            // Сравниваем ID чата из базы с искомым ID
            if ($chat->chat_id == $senderId) {
                log::info('Чат найден: ' . $chat);
                break; // Выходим из цикла, так как чат уже найден
            }
        }

        if (isset($chat)) {

            // $data = json_encode($this->message->toArray(), JSON_UNESCAPED_UNICODE); // Работа с входящим сообщением, можно обойтись без этого
            // $dataArray = json_decode($data, true);                                  // и сразу взять информацию из $chat

            // log::info($this->message->toArray());
            // log::info('Входное сообщение в json формате: ' . json_encode($this->message->toArray(), JSON_UNESCAPED_UNICODE));
            // log::info('Входное сообщение в формате ассоциативного массива: ', json_decode($data, true));

            

            // Данные можно быть взять так $this->message->from()->username(). Но для лучшего понимания сделал сложнее
            log::info('Входные данные в формате ассоциативного массива: ', $this->message->toArray()); 
            $dataArray = $this->message->toArray();
            
            if (isset($dataArray['from']['username'])) {
                $username = '@' . $dataArray['from']['username'];
                $idChat = $dataArray['from']['id']; 
                Log::info('Username отправителя: ' . $username);
                Log::info('id chat отправителя: ' . $idChat);
            } else {
                Log::info('Username не найден в данных.');
            }
    
            $chat->message('Выберите действие')
            ->keyboard(Keyboard::make()->buttons([  
                Button::make("👀 Открыть сайт")->url(config('app.url')),  
                Button::make("📰 Подписаться на новости")->action('subscribe')->param('user', $username),
                Button::make( "💰 Поддержать разработчика")->action('thanks')->param('user', $username)
            ]))->send();
        } else {
            // Ничего не найдено
        }


        
        
    }
    

    public function subscribe(){
        
        $user = $this->data->get('user');
        $this->reply("Спасибо за подписку $user");
    }

    public function thanks(){
        $user = $this->data->get('user');
        $this->reply("Спасибо за поддержку $user 🎉🎉🎉");
    }

    protected function handleUnknownCommand(Stringable $text): void
{
    $availableCommands = [
        '/start' => 'Начать работу с ботом',
        '/actions' => 'Различные действия',
        '/weather' => 'Узнать погоду в вашем городе',
        
    ];

    $commandList = "Доступные команды:\n";
    foreach ($availableCommands as $command => $description) {
        $commandList .= "$command - $description\n";
    }

    $this->reply("Похоже, ты неверно ввел команду :(\n$commandList");
    
}


    protected function handleChatMessage(Stringable $text): void
    {
        if ($text->value() == 'Привет' || $text->value() == 'Здравствуйте' ){
            $this->reply($text);
        } else {

            $this->reply("Пока я вас не понимаю *:(*");
            $data = json_encode($this->message->toArray(), JSON_UNESCAPED_UNICODE); //json строка
            $dataArray = json_decode($data, true); // ассоциативный массив

            log::info($data); // логирование в laravel.log
            log::info($dataArray); // логирование в laravel.log
        }
    
    }

    public function weather()
{
    // Получите город, для которого нужно узнать погоду, из сообщения пользователя.
    // Предположим, что город находится в тексте сообщения после команды, например, "/weather New York".
    $text = $this->message->text();
    $parts = explode(' ', $text);
    
    if (count($parts) < 2) {
        $this->reply("Пожалуйста, укажите город после команды /weather.");
        return;
    }
    
    $city = $parts[1];

    // Отправьте запрос к wttr.in для получения погоды в указанном городе на русском языке.
    $url = "https://wttr.in/$city?format=%t+%c+%w+%m&lang=ru";
    
    // Выполните HTTP-запрос и получите ответ.
    $response = file_get_contents($url);

    // Теперь у вас есть данные о погоде на русском языке, которые вы можете отправить пользователю.
    $this->reply("Погода в городе $city:\n$response");
}




}


