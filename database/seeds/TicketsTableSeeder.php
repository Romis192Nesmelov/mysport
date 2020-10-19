<?php

use Illuminate\Database\Seeder;
use App\Ticket;
use App\Chat;
use App\QuestionFile;
use App\User;

class TicketsTableSeeder extends Seeder
{
    public function run()
    {
        $ipsumString = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. At auctor urna nunc id cursus metus aliquam eleifend mi. Tortor aliquam nulla facilisi cras fermentum odio';
        
        for ($t=0;$t<10;$t++) {
            $ticket = Ticket::create([
                'head' => 'Test ticket #'.($t+1),
                'status' => 0,
                'user_id' => 2
            ]);
            
            for ($c=0;$c<rand(1,10);$c++) {
                $chat = Chat::create([
                    'question' => mb_substr($ipsumString,rand(0,50),rand(10,230)).'.',
                    'answer' => mb_substr($ipsumString,rand(0,50),rand(10,230)).'.',
                    'ticket_id' => $ticket->id
                ]);

                $imagesCount = rand(0,5);
                for ($i=0;$i<$imagesCount;$i++) {
                    QuestionFile::create([
                        'file' => 'images/avatars/avatar1.jpg',
                        'chat_id' => $chat->id
                    ]);
                }
            }
        }
    }
}