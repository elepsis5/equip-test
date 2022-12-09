<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        Eloquent::unguard();

//        $this->call('UserTableSeeder');
//        $this->command->info('User table seeded!');

        $path = 'database/test/test.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Test tables seeded!');
    }
}
