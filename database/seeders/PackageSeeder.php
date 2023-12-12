<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = 
        [
            [
                'name' => "Gói Pro",
                'price' => "2999999",
                'duration_id' => 1,
                'status' => 1,
                
            ],
            [
                'name' => "Gói Single",
                'price' => "3499999",
                'duration_id' => 1,
                'status' => 1,
            ],
            [
                'name' => "Gói 10 buổi",
                'price' => "2000000",
                'duration_id' => 2,
                'status' => 1,
            ],
            [
                'name' => "Gói 35 giờ",
                'price' => "7800000",
                'duration_id' => 4,
                'status' => 1,
            ]
        ];
        foreach ($datas as $data) {
            DB::table('packages')->insert($data);
        }
    }
}