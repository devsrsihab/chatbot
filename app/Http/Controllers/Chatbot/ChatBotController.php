<?php

namespace App\Http\Controllers\Chatbot;

use App\Models\Response;
use BotMan\BotMan\BotMan;
use App\Models\BotMessage;
use App\Http\Controllers\Controller;
use BotMan\BotMan\Messages\Incoming\Answer;

class ChatBotController extends Controller
{
    private $count = 0;
    public function handle()
    {
        $botman = app('botman');



        function getIPAddress() {  
            $userIpAdress = '';
            //whether ip is from the share internet  
             if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                        $userIpAdress = $_SERVER['HTTP_CLIENT_IP'];  
                }  
            //whether ip is from the proxy  
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                        $userIpAdress = $_SERVER['HTTP_X_FORWARDED_FOR'];  
             }  
            //whether ip is from the remote address  
            else{  
                     $userIpAdress = $_SERVER['REMOTE_ADDR'];  
             }  
             return $userIpAdress;  
        }  
       



        $botman->hears('{message}', function (BotMan $message) {
            $message->typesAndWaits(3);

            $userText = $message->getMessage()->getText();
            // dd($userText);

            $responses = Response::join('keywords', 'keywords.id', '=', 'responses.keywords_id')
                        ->where('keywords.chat_keyword','like',"%$userText%")
                        ->limit(1)
                        ->inRandomOrder()
                        ->get(['responses.chat_response'])
                        ->toArray();                                   
                                                    
           
            if(!empty($responses)){
                $message->reply($responses[0]['chat_response']);
            }else {
                $message->reply("I'm sorry, but I'm unable to understand your message. Can you please provide more information or ask a specific question? I'll do my best to assist you once I understand your request.");
            }
            
            //user data store in database
            $BotMessage                 = new BotMessage;
            $BotMessage->user_ip_adress = getIPAddress();
            $BotMessage->user_message   = $userText;
            $BotMessage->save();

        });

        $botman->listen();
    }
}


