<?php

use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'name' => 'nrri',
        ]);

    }
}
