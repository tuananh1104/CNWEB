<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class IssuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Tạo 20 bản ghi ngẫu nhiên cho bảng issues
        foreach (range(1, 20) as $index) {
            DB::table('issues')->insert([
                'computer_id' => $faker->numberBetween(1, 10), // Tham chiếu ID từ bảng computers
                'reported_by' => $faker->name(),
                'reported_date' => $faker->dateTimeThisYear(),
                'description' => $faker->sentence(),
                'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
