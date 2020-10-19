<?php

use Illuminate\Database\Seeder;
use App\Contract;
use App\ContractDirection;

class ContractsTableSeeder extends Seeder
{
    public function run()
    {
        for ($i=0;$i<10;$i++) {
            $deadline = time() + (60 * 60 + (24 * rand(6,20)));
            $contract = Contract::create([
                'name' => mb_substr('Semper eget duis at tellus',0,rand(15,26)),
                'description' => mb_substr('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. At auctor urna nunc id cursus metus aliquam eleifend mi. Tortor aliquam nulla facilisi cras fermentum odio',0,rand(150,230)).'.',
                'value' => rand(10,10000),
                'deadline' => $deadline,
                'deadline_prev' => $deadline,
                'status' => 2,
                'user_id' => 1
            ]);

            ContractDirection::create([
                'contract_id' => $contract->id,
                'direction_id' => rand(1,6)
            ]);
        }
    }
}