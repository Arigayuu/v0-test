<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Dobok Taekwondo Poomsae',
                'description' => 'Dobok berkualitas tinggi untuk poomsae, nyaman dan tahan lama.',
                'price' => 500000,
                'stock' => 50,
                'category' => 'dobok',
                'brand' => 'Mooto',
                'size' => 'M',
                'image' => null, // Placeholder, you can add image logic later
            ],
            [
                'name' => 'Sabuk Taekwondo Hitam',
                'description' => 'Sabuk hitam standar WTF, kualitas premium.',
                'price' => 150000,
                'stock' => 100,
                'category' => 'belt',
                'brand' => 'Adidas',
                'size' => 'Universal',
                'image' => null,
            ],
            [
                'name' => 'Pelindung Dada Taekwondo',
                'description' => 'Body protector ringan dan kuat untuk latihan dan pertandingan.',
                'price' => 300000,
                'stock' => 30,
                'category' => 'protection',
                'brand' => 'Daedo',
                'size' => 'L',
                'image' => null,
            ],
            [
                'name' => 'Sarung Tangan Taekwondo',
                'description' => 'Sarung tangan pelindung untuk sparring.',
                'price' => 100000,
                'stock' => 80,
                'category' => 'protection',
                'brand' => 'Everlast',
                'size' => 'S',
                'image' => null,
            ],
            [
                'name' => 'Matras Puzzle Taekwondo',
                'description' => 'Matras puzzle empuk dan aman untuk area latihan.',
                'price' => 200000,
                'stock' => 20,
                'category' => 'accessories',
                'brand' => 'JCALICU',
                'size' => '1x1m',
                'image' => null,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
} 