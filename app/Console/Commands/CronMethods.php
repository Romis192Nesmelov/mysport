<?php

use Illuminate\Console\Command;
use App\Http\Controllers\HelperTrait;
use App\Order;
use App\Tasting;

class CronMethods extends Command
{
    use HelperTrait;

//    public function dailyMail()
//    {
//        $this->dailyMailing();
//    }
}