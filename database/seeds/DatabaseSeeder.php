<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ChaptersTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(DirectionsTableSeeder::class);
        $this->call(ContractsTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(MyResumeTableSeeder::class);
    }
}
