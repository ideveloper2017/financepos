<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Telegram\Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;



class TelegramBotController extends Controller
{
    protected $bot_token;
    protected $telegram;
    protected $text;
    protected Collection $data;
    protected $callback_query;

    public function __construct()
    {
        $this->bot_token = '6829236629:AAHxKFnhynNcpGhw4tDIMoQZxoaHQdZcPss';
        $this->telegram=new Telegram($this->bot_token);

    }
    public function handler(Request $request)
    {
        $this->text=$this->telegram->Text();

        $chat_id=$this->telegram->ChatID();
        $data = [
            "chat_id"   => $chat_id,
            'menu_button' => json_encode(
                array (
                    "type" => "web_app",
                    "text" => "Menu",
                    "web_app" => array (
                        "url" => "MYWEBSITE"
                    )
                )
            )
        ];

        switch ($this->text){
            case '/start':
                $option = [
                    [$this->telegram->buildKeyboardButton("Mahsuloatlar"),
                          $this->telegram->buildKeyboardButton("Button 2")],
                    [$this->telegram->buildKeyboardButton("Button 3"),
                        $this->telegram->buildKeyboardButton("Button 4"),
                        $this->telegram->buildKeyboardButton("Button 5")],
                    array($this->telegram->buildKeyboardButton("Button 6"))];
                $keyb = $this->telegram->buildKeyBoard($option, true,true);
                $content = ['chat_id' => $chat_id,'reply_markup' => $keyb, 'text' => '<b>Welcome to Test GameBot !</b>','parse_mode'=>'HTML'];
                $this->telegram->sendMessage($content);
                break;
            case '/categories':
                $this->categories();
                break;
            case '/brands':
                $this->brands();;
                break;



        }

    }


    public function products(Stringable $text)
    {
        $buttons = [];
        $keyboard=[];
        $products = Product::with('unit', 'category', 'brand')
            ->where(function ($query) use ($text) {
                return $query->where('products.name', '=', $text)
                    ->orWhere(function ($query) use ($text) {
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
            $buttons[] = $this->telegram->buildKeyboardButton($product->name);
        }
        foreach (array_chunk($buttons, 3) as $chunk) {
            $keyboard[]=$chunk;
        }
        $keyb = $this->telegram->buildKeyBoard([$keyboard], true,true);
        $content = array('chat_id' => $this->telegram->ChatID(), 'reply_markup' => $keyb, 'text' => "This is a Keyboard Test");
        $this->telegram->sendMessage($content);


    }
    public function categories()
    {
        try {
            $buttons = [];
            $keyboard=[];
            $categories = Category::where('deleted_at', '=', null)->get();;
            foreach ($categories as $key => $butacat) {
                $buttons[$key] = $this->telegram->buildKeyboardButton($butacat->name);
            }
//            $keyboard = ReplyKeyboard::make()->resize()->oneTime();
            foreach (array_chunk($buttons, 3) as $chunk) {
                $keyboard[]=($chunk);
            }
            $keyb = $this->telegram->buildKeyBoard($keyboard, true,true);
            $content = array('chat_id' => $this->telegram->ChatID(), 'reply_markup' => $keyb, 'text' => "This is a Keyboard Test");
            $this->telegram->sendMessage($content);
//            Telegraph::message('Категорияларни танланг!!!')->replyKeyboard($keyboard)->send();
        } catch (\Exception $e){
            $content = array('text' => "This is a Keyboard Test");
            $this->telegram->sendMessage($content);
        }
    }

    public function brands()
    {
        $buttons = [];
        $keyboard=[];
        $brands = Brand::where('deleted_at', '=', null)->get();
        foreach ($brands as $key => $brand) {
            $buttons[] = $this->telegram->buildKeyboardButton($brand->name);
        }

        foreach (array_chunk($buttons, 3) as $chunk) {
            $keyboard[]=$chunk;
        }
        $keyb = $this->telegram->buildKeyBoard($keyboard, true,true);
        $content = array('chat_id' => $this->telegram->ChatID(), 'reply_markup' => $keyb, 'text' => "This is a Keyboard Test");
        $this->telegram->sendMessage($content);
    }
}

