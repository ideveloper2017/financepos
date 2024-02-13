<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;
use Telegram;


class TelegramBotController extends Controller
{
    protected $bot_token;
    protected $telegram;
    protected $text;
    protected Collection $data;
    protected $callback_query;

    public function __construct()
    {
        $this->bot_token = '6531116972:AAFV_hrRWBi6PJqZ5Jg0z-udScYlLzAcdD0';
        $this->telegram=new Telegram($this->bot_token);

    }
    public function handler(Request $request)
    {
        $this->text=$this->telegram->Text();
        $chat_id=$this->telegram->ChatID();

        switch ($this->text){
            case '/start':
                $content = ['chat_id' => $chat_id, 'text' => 'Welcome to Test GameBot !'];
                $menu = [["Inline"],["Google News"],["button 1","button 2"]];
//                $this->telegram->setChatMenuButton($menu);
                $this->telegram->sendMessage($content);
                break;
            case '/where':
                // Send the Catania's coordinate
                $content = ['chat_id' => $chat_id, 'latitude' => '37.5', 'longitude' => '15.1'];
                $this->telegram->sendLocation($content);
            break;
            case '/replykeyboard':

                $option = [
                    //First row
                    [$this->telegram->buildKeyboardButton("Button 1"), $this->telegram->buildKeyboardButton("Button 2")],
                    //Second row
                    [$this->telegram->buildKeyboardButton("Button 3"), $this->telegram->buildKeyboardButton("Button 4"),
                        $this->telegram->buildKeyboardButton("Button 5")],
                    //Third row
                    [$this->telegram->buildKeyboardButton("Button 6")]];
                $keyb = $this->telegram->buildKeyBoard($option, $onetime=false);
                $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "This is a Keyboard Test");
                $this->telegram->sendMessage($content);
                break;
            case '/inlinekeyboard':
                $this->products($this->text);
//                $option = [
//                    [
//                        $this->telegram->buildInlineKeyBoardButton('Callback 1', $url = '', $callback_data = '1'),
//                        $this->telegram->buildInlineKeyBoardButton('Callback 2', $url = '', $callback_data = '2'),
//                    ],
//                ];
//                $keyb = $this->telegram->buil($option);
//                $content=['chat_id'=>$chat_id,'reply_markup'=>$keyb,'text'=>'This is an InlineKeyboard Test with Callbacks'];
//                $this->telegram->sendMessage($content);
                $option = array(
                    //First row
                    array($this->telegram->buildInlineKeyBoardButton("Button 1", $url="http://link1.com"), $this->telegram->buildInlineKeyBoardButton("Button 2", $url="http://link2.com")),
                    //Second row
                    array($this->telegram->buildInlineKeyBoardButton("Button 3", $url="http://link3.com"), $this->telegram->buildInlineKeyBoardButton("Button 4", $url="http://link4.com"),
                        $this->telegram->buildInlineKeyBoardButton("Button 5", $url="http://link5.com")),
                    //Third row
                    array($this->telegram->buildInlineKeyBoardButton("Button 6", $url="http://link6.com")) );
                $keyb = $this->telegram->buildInlineKeyBoard($option);
                $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "This is a Keyboard Test");
                $this->telegram->sendMessage($content);
                break;
        }

    }


    public function products(Stringable $text)
    {
        $buttons = [];
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
            $this->data->add($product);
            $buttons[$key] = $this->telegram->buildKeyboardButton($product->name);
        }
        foreach (array_chunk($buttons, 3) as $chunk) {
            $buttons[]=$chunk;
        }
        $keyb = $this->telegram->buildKeyBoard($buttons, $onetime=false);
        $content = array('chat_id' => $this->telegram->ChatID(), 'reply_markup' => $keyb, 'text' => "This is a Keyboard Test");
        $this->telegram->sendMessage($content);


    }
    public function categories()
    {
        try {
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
        } catch (\Exception $e){
            $this->reply($e->getMessage());
        }
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

