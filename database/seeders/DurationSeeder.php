<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = 
        [
            // [
            //     'name' => "30 ngày",
            //     'amount' => "30",
            //     'unit' => "day",
            // ],
            // [
            //     'name' => "35 ngày",
            //     'amount' => "35",
            //     'unit' => "day",
            // ],
            // [
            //     'name' => "35 giờ",
            //     'amount' => "35",
            //     'unit' => "hour",
            // ],
            [
                'name' => "80 ngày",
                'amount' => "80",
                'unit' => "day",
            ]
        ];
        foreach ($datas as $data) {
            DB::table('durations')->insert($data);
        }
    }
}