<?php

namespace App\Http\Controllers\Chatbot;

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

        $greetingKeywords = ['hi', 'hello', 'hola', 'hey', 'bonjour'];
        $companyKeywords = [
            'Tell me about Afla.',
            'What is Afla?',
            'Can you give me some information about Afla?',
            'Who is Afla?',
            'What does Afla do?',
            'Can you tell me more about your company Afla?',
            'I\'m interested in Afla. What can you tell me about it?',
            'about afla',
            'info',
            'afla',
            'detail',
            'details',
            'company'
        ];

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


           $keyWords = ['hi','hello','hey'];
           if (in_array($userText,$keyWords)) {
            $message->reply('Yeah Your code is work?');

           }

            if (preg_match("/\bsohan\b/i", $userText, $matches)) {
                $message->reply('Hello, How was you day?');
            }
            elseif(preg_match("/\band you|how are you|how are you ?|you ?|you?\b/i", $userText, $matches))
            {
                $responses = [
                    "While I don't have emotions like humans do, I am still here to help you with any questions or tasks you have. How may I assist you today?",
                    "As a Chatbot, I don't have feelings or emotions, but I am here to help you with any questions or tasks you have. How may I assist you today?",
                    "As a Chatbot, I am not capable of having feelings or emotions, but I am here to assist you with any questions or tasks you have. How may I help you today?",
                    "I may not have emotions like humans do, but I am still able to assist you with any questions or tasks you have. How may I assist you today?",
                    "As a Chatbot, I am not capable of feeling emotions like humans do, but I am still here to assist you with any questions or tasks you have. How may I help you today?",
                    "While I may not have emotions like humans do, I am still fully functional and able to assist you with any questions or tasks you have. How may I help you today?",
                    "As a Chatbot, I don't have the ability to experience emotions like humans do, but I am still here to help you with any questions or tasks you have. How may I assist you today?",
                    "While I may not be capable of having emotions like humans do, I am still here to assist you with any questions or tasks you have. How may I help you today?",
                    "As an AI-powered Chatbot, I don't experience emotions like humans do, but I am still ready to assist you with any questions or tasks you have. How may I assist you today?",
                    "As a Chatbot, I don't have emotions or feelings like humans do, but I am fully functional and here to help you with any questions or tasks you have. How may I assist you today?"
                ];
                
                $randomIndex = array_rand($responses);
                $message->reply($responses[$randomIndex]);
                
    
            }
            elseif(preg_match("/\bwell|good|better|it's is fine|it is fine|fine|very fine|very good|great\b/i", $userText, $matches))
            {
                $responses = [
                    "That's great news!",
                    "I'm happy to hear that!",
                    "Wonderful to hear!",
                    "That's music to my ears!",
                    "I'm delighted to hear that!",
                    "That's fantastic!",
                    "That's excellent to hear!",
                    "It's good to hear that!",
                    "That's a relief!",
                    "I'm thrilled to hear that!"
                ];
                $randomIndex = array_rand($responses);  
                $message->reply($responses[$randomIndex]);
    
            }
            elseif (preg_match("/\babout|about afla|afla|tell me about your compnay|tell me som|about afla.app\b/i", $userText, $matches)) {
                
                $responses = [
                    "Afla.app is a platform designed to help online content creators and marketers improve their online presence and grow their businesses. With features such as SEO optimization, social media monitoring, and competitor analysis, Afla.app provides users with valuable insights and analytics to make data-driven decisions and stay ahead of the competition.",
                    "Whether you're a blogger, influencer, or business owner, Afla.app has the tools you need to succeed online. Our platform includes a range of features such as SEO optimization, social media monitoring, and competitor analysis to help you grow your business and achieve your marketing goals.",
                    "Afla.app offers a suite of powerful tools designed to help online content creators and marketers improve their online presence and grow their businesses. With features such as SEO optimization, social media monitoring, and competitor analysis, Afla.app provides users with valuable insights and analytics to help them make data-driven decisions.",
                    "At Afla.app, we understand the challenges faced by online content creators and marketers. That's why we offer a suite of tools designed to help you improve your online presence and grow your business. With features such as SEO optimization, social media monitoring, and competitor analysis, Afla.app provides users with valuable insights and analytics to help them stay ahead of the competition.",
                    "Afla.app is a website that offers a range of tools to help online content creators and marketers improve their online presence and grow their businesses. With features such as SEO optimization, social media monitoring, and competitor analysis, Afla.app provides users with valuable insights and analytics to help them make data-driven decisions.",
                    "If you're an online content creator or marketer, Afla.app is the platform for you. Our suite of tools includes features such as SEO optimization, social media monitoring, and competitor analysis to help you improve your online presence and grow your business. Afla.app provides users with valuable insights and analytics to help them stay ahead of the competition.",
                    "At Afla.app, we're dedicated to helping online content creators and marketers achieve their goals. That's why we offer a suite of tools designed to help you improve your online presence and grow your business. With features such as SEO optimization, social media monitoring, and competitor analysis, Afla.app provides users with valuable insights and analytics to help them succeed.",
                    "If you're looking to improve your online presence and grow your business, Afla.app is the platform for you. Our suite of tools includes features such as SEO optimization, social media monitoring, and competitor analysis to help you stay ahead of the competition. Afla.app provides users with valuable insights and analytics to help them make data-driven decisions.",
                    "Afla.app is a website that provides a range of tools to help online content creators and marketers succeed. With features such as SEO optimization, social media monitoring, and competitor analysis, Afla.app provides users with valuable insights and analytics to help them make informed decisions and stay ahead of the competition.",
                    "At Afla.app, we're passionate about helping online content creators and marketers achieve their goals. Our suite of tools includes features such as SEO optimization, social media monitoring, and competitor analysis, providing users with valuable insights and analytics to help them succeed online.",
                    "If you're an online content creator or marketer, Afla.app can help you grow your business and achieve your marketing goals. With features such as SEO optimization, social media monitoring, and competitor analysis, Afla.app provides users with valuable insights and analytics to help them stay ahead of the competition.",
                    "Afla.app is a platform that provides a suite"
];
                    $randomIndex = array_rand($responses);
                    $message->reply($responses[$randomIndex]);

            }
            elseif (preg_match("/\bwho are you?|whoareyou|who are you\b/i", $userText, $matches)) {
               $responses = [
                "My name is Chatbot, and I am a language model developed by Afla.app. My goal is to help you with any questions you may have about Afla and provide you with helpful responses.",
                "As a Chatbot developed by Afla.app, I am here to assist you with any inquiries you may have about Afla and provide you with helpful answers to the best of my abilities.",
                "I'm an AI-powered Chatbot developed by Afla.app to help you with any questions you may have about the platform. My purpose is to provide you with helpful responses and assist you in any way I can.",
                "Hello! I am a Chatbot developed by Afla.app. My purpose is to assist you with any questions you may have about the platform and provide you with helpful responses.",
                "As an AI-powered Chatbot developed by Afla.app, I am here to assist you with any inquiries you may have about the platform and provide you with helpful responses.",
                "My name is Chatbot, and I am here to assist you with any questions you may have about Afla.app. As a language model developed by the company, my purpose is to provide you with helpful responses.",
                "Hello there! I'm an AI-powered Chatbot developed by Afla.app. My goal is to help you with any questions you may have about the platform and provide you with helpful answers.",
                "I am a Chatbot developed by Afla.app. My purpose is to assist you with any inquiries you may have about the platform and provide you with helpful responses to the best of my abilities.",
                "Greetings! I'm an AI-powered Chatbot developed by Afla.app. My purpose is to assist you with any questions you may have about the platform and provide you with helpful responses.",
                "As a Chatbot developed by Afla.app, I am here to assist you with any questions you may have about the platform and provide you with helpful responses to the best of my abilities."
            ];
            $randomIndex = array_rand($responses);
            $message->reply($responses[$randomIndex]);

            }
            elseif (preg_match("/\bcan you give me afla link|afla link|afla website link|afla web link|afla link\b/i", $userText, $matches)) {

                $responses = [
                    "At Afla.app, we offer a comprehensive suite of online tools that are specifically designed to help content creators improve their online presence. You can check them out at https://afla.app/.",
                    "Our platform, Afla.app, provides a comprehensive suite of online tools that are designed to help content creators improve their online presence. You can find out more by visiting https://afla.app/.",
                    "Afla.app is a platform that offers a comprehensive suite of online tools designed to help content creators improve their online presence. Check out our tools at https://afla.app/.",
                    "Our goal at Afla.app is to provide content creators with a comprehensive suite of online tools that can help them improve their online presence. You can learn more at https://afla.app/.",
                    "If you're a content creator looking to improve your online presence, Afla.app offers a comprehensive suite of online tools that can help. Visit us at https://afla.app/ to learn more.",
                    "At Afla.app, we understand the importance of having a strong online presence as a content creator. That's why we offer a comprehensive suite of online tools to help. Check them out at https://afla.app/.",
                    "Looking to improve your online presence as a content creator? Afla.app has you covered with a comprehensive suite of online tools. Visit us at https://afla.app/ to learn more.",
                    "As a content creator, having a strong online presence is crucial. That's why Afla.app offers a comprehensive suite of online tools designed to help. Check them out at https://afla.app/.",
                    "At Afla.app, we are dedicated to helping content creators improve their online presence with our comprehensive suite of online tools. Visit us at https://afla.app/ to learn more.",
                    "Afla.app is a platform that provides content creators with a comprehensive suite of online tools to help improve their online presence. Check out our tools at https://afla.app/."
                ];
                
                $randomIndex = array_rand($responses);
                $message->reply($responses[$randomIndex]);
                
            }
            
            else {
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


