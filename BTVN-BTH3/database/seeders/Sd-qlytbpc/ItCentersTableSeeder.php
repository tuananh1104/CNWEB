<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ItCentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('it_centers')->insert([
            'name' => 'Trung tâm Tin học ABC', 
            'location' => '456 Đường Y, TP.HCM', 
            'contact_email' => 'contact@abc.com',
        ]);
    }
}
