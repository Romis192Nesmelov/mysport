<?php

use Illuminate\Database\Seeder;
use App\MyResume;
use App\Work;
use App\User;
use App\ResumeDirection;
use App\Portfolio;
use Carbon\Carbon;

class MyResumeTableSeeder extends Seeder
{
    public function run()
    {
        $ipsumString = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. At auctor urna nunc id cursus metus aliquam eleifend mi. Tortor aliquam nulla facilisi cras fermentum odio';
        $skills = [
            ['directions' => [1,2], 'skill' => 'php, javascript, actionscript (2.0, 3.0), MySQL, HTML5, CSS3, Laravel'],
            ['directions' => [5], 'skill' => 'Creative Suite, 3D MAX, Quark Xpress, Corel DRAW'],
            ['directions' => [4], 'skill' => 'Linux (Ubuntu, Debian), ssh, git, svn']
        ];
        $users = User::where('id',2)->get();

        foreach ($users as $user) {
            foreach ($skills as $k => $skill) {
                $resume = MyResume::create([
                    'name' => 'Test resume #'.($k+1),
                    'skills' => $skill['skill'],
                    'status' => 2,
                    'user_id' => $user->id,
                ]);
                
//                foreach ($skill['directions'] as $id) {
                    ResumeDirection::create([
                        'my_resume_id' => $resume->id,
                        'direction_id' => 2
                    ]);
//                }

                for ($i=0;$i<10;$i++) {
                    $startTime = Carbon::create(2000+$i, 1, 1, 12, 00, 0, 'GMT');
                    $endTime = Carbon::create(2000+($i+1), 1, 1, 12, 00, 0, 'GMT');

                    Work::create([
                        'start_time' => $startTime->toDateTimeString(),
                        'end_time' => $endTime->toDateTimeString(),
                        'name' => 'Test Work #'.($i+1),
                        'description' => mb_substr($ipsumString,rand(0,50),rand(10,230)).'.',
                        'status' => 2,
                        'my_resume_id' => $resume->id
                    ]);
                }

                for ($i=0;$i<rand(1,5);$i++) {
                    Portfolio::create([
                        'image' => $i%2 === 0 ? 'images/portfolios/test.jpg' : null,
                        'link' => $i%2 === 0 ? null : 'http://www.nesmelov.com/',
                        'description' => mb_substr($ipsumString,0,rand(10,20)).'.',
                        'status' => 2,
                        'my_resume_id' => $resume->id
                    ]);
                }
            }
        }
    }
}