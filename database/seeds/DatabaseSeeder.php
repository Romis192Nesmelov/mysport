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
        $this->call(NewsTableSeeder::class);
        $this->call(KindOfSportTableSeeder::class);
        $this->call(TrainersTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(OrganizationsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
    }
}
