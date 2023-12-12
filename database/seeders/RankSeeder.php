<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = 
        [
            [
                'name' => "Bạc",
            ],
            [
                'name' => "Vàng",
            ],
            [
                'name' => "Ruby",
            ],
            [
                'name' => "Kim Cương",
            ]
        ];
        foreach ($datas as $data) {
            DB::table('ranks')->insert($data);
        }
    }
}