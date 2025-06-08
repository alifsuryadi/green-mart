<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get users
        $admin = User::where('email', 'admin@greenmart.com')->first();
        $julia = User::where('email', 'julia@greenmart.com')->first();
        $robert = User::where('email', 'robert@greenmart.com')->first();

        // Admin products
        $adminProducts = [
            ['user_id' => $admin->id, 'name' => 'Obat Batuk Herbal', 'order_number' => 1],
            ['user_id' => $admin->id, 'name' => 'Vitamin C 1000mg', 'order_number' => 2],
            ['user_id' => $admin->id, 'name' => 'Masker Medis 3 Ply', 'order_number' => 3],
            ['user_id' => $admin->id, 'name' => 'Hand Sanitizer 500ml', 'order_number' => 4],
            ['user_id' => $admin->id, 'name' => 'Thermometer Digital', 'order_number' => 5],
        ];

        // Julia products
        $juliaProducts = [
            ['user_id' => $julia->id, 'name' => 'Suplemen Omega 3', 'order_number' => 1],
            ['user_id' => $julia->id, 'name' => 'Madu Murni 500gr', 'order_number' => 2],
            ['user_id' => $julia->id, 'name' => 'Teh Herbal Detox', 'order_number' => 3],
        ];

        // Robert products
        $robertProducts = [
            ['user_id' => $robert->id, 'name' => 'Plester Luka Waterproof', 'order_number' => 1],
            ['user_id' => $robert->id, 'name' => 'Obat Maag Cair', 'order_number' => 2],
            ['user_id' => $robert->id, 'name' => 'Salep Anti Gatal', 'order_number' => 3],
            ['user_id' => $robert->id, 'name' => 'Obat Tetes Mata', 'order_number' => 4],
        ];

        foreach ($adminProducts as $product) {
            Product::create($product);
        }

        foreach ($juliaProducts as $product) {
            Product::create($product);
        }

        foreach ($robertProducts as $product) {
            Product::create($product);
        }
    }
}