<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => '腕時計',
                'price' => '15000',
                'brand' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'image' => 'images/Armani+Mens+Clock.jpg',
                'condition_id' => '1',
                'status' => 'available'
            ],
            [
                'name' => 'HDD',
                'price' => '5000',
                'brand' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'image' => 'images/HDD+Hard+Disk.jpg',
                'condition_id' => '2',
                'status' => 'available'
            ],
            [
                'name' => '玉ねぎ3束',
                'price' => '300',
                'brand' => 'なし',
                'description' => '新鮮な玉ねぎ3束のセット',
                'image' => 'images/iLoveIMG+d.jpg',
                'condition_id' => '3',
                'status' => 'available'
            ],
            [
                'name' => '革靴',
                'price' => '4000',
                'brand' => '',
                'description' => 'クラシックなデザインの革靴',
                'image' => 'images/Leather+Shoes+Product+Photo.jpg',
                'condition_id' => '4',
                'status' => 'available'
            ],
            [
                'name' => 'ノートPC',
                'price' => '45000',
                'brand' => '',
                'description' => '高性能のノートパソコン',
                'image' => 'images/Living+Room+Laptop.jpg',
                'condition_id' => '1',
                'status' => 'available'
            ],
            [
                'name' => 'マイク',
                'price' => '8000',
                'brand' => 'なし',
                'description' => '高音質のレコーディング用マイク',
                'image' => 'images/Music+Mic+4632231.jpg',
                'condition_id' => '2',
                'status' => 'available'
            ],
            [
                'name' => 'ショルダーバッグ',
                'price' => '3500',
                'brand' => '',
                'description' => 'おしゃれなショルダーバッグ',
                'image' => 'images/Purse+fashion+pocket.jpg',
                'condition_id' => '3',
                'status' => 'available'
            ],
            [
                'name' => 'タンブラー',
                'price' => '500',
                'brand' => 'なし',
                'description' => '使いやすいタンブラー',
                'image' => 'images/Tumbler+souvenir.jpg',
                'condition_id' => '4',
                'status' => 'available'
            ],
            [
                'name' => 'コーヒーミル',
                'price' => '4000',
                'brand' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'image' => 'images/Waitress+with+Coffee+Grinder.jpg',
                'condition_id' => '1',
                'status' => 'available'
            ],
            [
                'name' => 'メイクセット',
                'price' => '2500',
                'brand' => '',
                'description' => '便利なメイクアップセット',
                'image' => 'images/外出メイクアップセット.jpg',
                'condition_id' => '2',
                'status' => 'available'
            ],
        ]);
    }
}
