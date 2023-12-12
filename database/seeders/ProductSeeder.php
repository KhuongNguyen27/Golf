<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Bóng tập 5h-16h',
                'quantity' => 1000,
                'price' => 130000000,
                'status' => 1,
            ],
            [
                'name' => 'Bóng tập 16h-21h',
                'quantity' => 1000,
                'price' => 130000000,
                'status' => 1,
            ],
            [
                'name' => 'Vip 1 t2-t6 5h-16h',
                'quantity' => 1000,
                'price' => 2900000000,
                'status' => 1,
            ]
        ];
        foreach ($datas as $data) {
            DB::table('products')->insert($data);
        }
    }
}