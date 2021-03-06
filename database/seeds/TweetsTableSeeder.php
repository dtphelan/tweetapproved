<?php

use Illuminate\Database\Seeder;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tweets')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'tweet' => 'First sample tweet.',
            'status' => 0,
        ]);

        DB::table('tweets')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'tweet' => 'Second sample tweet.',
            'status' => 0,
            'organization' => 'nrri',
        ]);

        DB::table('tweets')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'tweet' => 'Third sample tweet.',
            'status' => 0,
        ]);
    }
}
