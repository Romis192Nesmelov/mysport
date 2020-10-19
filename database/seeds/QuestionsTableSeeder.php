<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        for ($i=0;$i<4;$i++) {
            Question::create(
                [
                    'question_en' => 'Lorem ipsum dolor sit amet, consectetur?',
                    'question_ru' => 'Lorem ipsum может большой креативный адвантан?',
                    'answer_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit. Volutpat odio facilisis mauris sit amet massa.</p>',
                    'answer_ru' => '<p>Хотя фраза и бессмысленна, она имеет давнюю историю. Фраза использовалась печатниками многие столетия для демонстрации наиболее важных особенностей своих шрифтов. Она использовалась потому, что символы составляют сложные по межсимвольным промежуткам и по комбинациям символов пары, наилучшим образом демонстрирующие преимущества данного начертания.</p>',
                    'active' => true
                ]
            );
        }
    }
}