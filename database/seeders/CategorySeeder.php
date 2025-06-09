<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            switch ($product->name) {
                case 'Obat Batuk Herbal':
                    $categories = [
                        ['name' => 'Sirup Dewasa', 'description' => 'Untuk dewasa usia 12 tahun ke atas'],
                        ['name' => 'Sirup Anak', 'description' => 'Untuk anak usia 2-12 tahun'],
                        ['name' => 'Tablet Hisap', 'description' => 'Bentuk tablet dengan rasa mint'],
                    ];
                    break;

                case 'Vitamin C 1000mg':
                    $categories = [
                        ['name' => 'Tablet Effervescent', 'description' => 'Tablet larut dalam air'],
                        ['name' => 'Kapsul', 'description' => 'Kapsul mudah ditelan'],
                        ['name' => 'Gummy', 'description' => 'Bentuk permen kenyal rasa jeruk'],
                    ];
                    break;

                case 'Masker Medis 3 Ply':
                    $categories = [
                        ['name' => 'Masker Hijau', 'description' => 'Masker medis warna hijau'],
                        ['name' => 'Masker Biru', 'description' => 'Masker medis warna biru'],
                        ['name' => 'Masker Putih', 'description' => 'Masker medis warna putih'],
                    ];
                    break;

                case 'Hand Sanitizer 500ml':
                    $categories = [
                        ['name' => 'Gel', 'description' => 'Bentuk gel dengan alkohol 70%'],
                        ['name' => 'Spray', 'description' => 'Bentuk semprot praktis'],
                    ];
                    break;

                case 'Thermometer Digital':
                    $categories = [
                        ['name' => 'Thermometer Dahi', 'description' => 'Non-contact infrared'],
                        ['name' => 'Thermometer Telinga', 'description' => 'Pengukuran via telinga'],
                        ['name' => 'Thermometer Mulut', 'description' => 'Digital klasik'],
                    ];
                    break;

                case 'Suplemen Omega 3':
                    $categories = [
                        ['name' => 'Fish Oil 1000mg', 'description' => 'Minyak ikan murni'],
                        ['name' => 'Krill Oil', 'description' => 'Dari ekstrak krill antartika'],
                    ];
                    break;

                case 'Madu Murni 500gr':
                    $categories = [
                        ['name' => 'Madu Hutan', 'description' => 'Madu dari lebah hutan'],
                        ['name' => 'Madu Randu', 'description' => 'Madu dari bunga randu'],
                        ['name' => 'Madu Kelengkeng', 'description' => 'Madu dari bunga kelengkeng'],
                    ];
                    break;

                case 'Teh Herbal Detox':
                    $categories = [
                        ['name' => 'Green Tea Detox', 'description' => 'Teh hijau dengan jahe'],
                        ['name' => 'Chamomile Relax', 'description' => 'Teh chamomile untuk relaksasi'],
                        ['name' => 'Turmeric Ginger', 'description' => 'Kombinasi kunyit dan jahe'],
                    ];
                    break;

                case 'Plester Luka Waterproof':
                    $categories = [
                        ['name' => 'Ukuran Kecil', 'description' => '1.9 x 7.2 cm'],
                        ['name' => 'Ukuran Sedang', 'description' => '2.5 x 7.2 cm'],
                        ['name' => 'Ukuran Besar', 'description' => '7.2 x 10 cm'],
                    ];
                    break;

                case 'Obat Maag Cair':
                    $categories = [
                        ['name' => 'Rasa Original', 'description' => 'Rasa mint segar'],
                        ['name' => 'Rasa Anggur', 'description' => 'Dengan rasa anggur'],
                    ];
                    break;

                case 'Salep Anti Gatal':
                    $categories = [
                        ['name' => 'Tube 15gr', 'description' => 'Kemasan kecil praktis'],
                        ['name' => 'Tube 30gr', 'description' => 'Kemasan standar'],
                        ['name' => 'Tube 50gr', 'description' => 'Kemasan besar ekonomis'],
                    ];
                    break;

                case 'Obat Tetes Mata':
                    $categories = [
                        ['name' => 'Mata Merah', 'description' => 'Untuk mata merah dan iritasi'],
                        ['name' => 'Mata Kering', 'description' => 'Pelembab mata alami'],
                        ['name' => 'Mata Lelah', 'description' => 'Menyegarkan mata lelah'],
                    ];
                    break;

                default:
                    $categories = [
                        ['name' => 'Kategori 1', 'description' => 'Deskripsi kategori 1'],
                        ['name' => 'Kategori 2', 'description' => 'Deskripsi kategori 2'],
                    ];
                    break;
            }

            $orderNumber = 1;
            foreach ($categories as $category) {
                Category::create([
                    'product_id' => $product->id,
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'order_number' => $orderNumber++,
                ]);
            }
        }
    }
}