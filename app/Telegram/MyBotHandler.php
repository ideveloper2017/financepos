<?php

namespace App\Telegram;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Http\Request;
use Illuminate\Support\Stringable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class MyBotHandler extends WebhookHandler
{

    public function __construct()
    {
        /** @var \DefStudio\Telegraph\Models\TelegraphBot $bot */
        $bot = TelegraphBot::find(1);
        $bot->registerCommands([
            'start' => 'Restart Bot',
            'actions' => 'различные действия',
        ])->send();
    }

    public function hello(string $name): void
    {
        $this->reply("Привет, $name!");
    }

    public function actions(): void
    {
        Telegraph::message('Выбери какое-то действие')
            ->keyboard(
                Keyboard::make()->buttons([
//                    Button::make('Перейти на сайт')->url('https://areaweb.su'),
//                    Button::make('Поставить лайк')->action('like'),
                    Button::make('Категориялар')->action('categories'),
                    Button::make('Брендлар')->action('brans'),
//                    Button::make('Подписаться')
//                        ->action('subscribe')
//                        ->param('channel_name', '@areaweb'),
                ])
            )->send();
    }



    protected function handleChatMessage(Stringable $text): void
    {
        // in this example, a received message is sent back to the chat
        $this->chat->html("Received: $text")->send();
        $this->products($text);
    }


    protected function handleUnknownCommand(Stringable $text): void
    {


        if ($text->value() === '/start') {
            $this->reply('Рад тебя видеть! Давай начнем пользоваться мной :-)');


        } else {
            $this->reply('Неизвестная команда');
        }
    }

    protected function onFailure(Throwable $throwable): void
    {
        if ($throwable instanceof NotFoundHttpException) {
            throw $throwable;
        }
        report($throwable);

        $this->reply('sorry man, I failed');
    }

    public function products(Stringable $text)
    {
       $buttons = [];
       $products = Product::with('unit', 'category', 'brand')
           ->where(function ($query) use ($text) {
                   return $query->where(function ($query) use ($text) {
                           return $query->whereHas('category', function ($q) use ($text) {
                               $q->where('name', '=', $text);
                           });
                       })
                       ->orWhere(function ($query) use ($text) {
                           return $query->whereHas('brand', function ($q) use ($text) {
                               $q->where('name', '=', $text);
                           });
                       });

           })
           ->where('deleted_at', '=', null)->get();;
        foreach ($products as $key => $product) {
            $buttons[$key] = ReplyButton::make($product->name);
        }
        $keyboard = ReplyKeyboard::make()->resize()->oneTime();
        foreach (array_chunk($buttons, 3) as $chunk) {
            $keyboard->row($chunk);
        }
        Telegraph::message('Товарларни танланг!!!')->replyKeyboard($keyboard)->send();

    }
    public function categories(Stringable $text)
    {
        $buttons = [];
        $categories = Category::where('deleted_at', '=', null)->get();;
        foreach ($categories as $key => $butacat) {
            $buttons[$key] = ReplyButton::make($butacat->name);
        }
        $keyboard = ReplyKeyboard::make()->resize()->oneTime();
        foreach (array_chunk($buttons, 3) as $chunk) {
            $keyboard->row($chunk);
        }
        Telegraph::message('Категорияларни танланг!!!')->replyKeyboard($keyboard)->send();
    }

    public function brans()
    {
        $buttons = [];
        $brands = Brand::where('deleted_at', '=', null)->get();
        foreach ($brands as $key => $brand) {
            $buttons[$key] = ReplyButton::make($brand->name);
        }
        $keyboard = ReplyKeyboard::make();
        foreach (array_chunk($buttons, 3) as $chunk) {
            $keyboard->row($chunk)->resize()->oneTime();
        }
        Telegraph::message('Брендларни танланг!!!')->replyKeyboard($keyboard)->send();
    }
}
