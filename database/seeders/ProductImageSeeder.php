<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductImageSeeder extends Seeder
{
    private $productImages = [
        'Obat Batuk Herbal' => [
            'colors' => ['FF6B6B', '4ECDC4', '45B7D1'],
            'text' => 'Obat Batuk'
        ],
        'Vitamin C 1000mg' => [
            'colors' => ['FFA502', 'FF6348', 'FF4757'],
            'text' => 'Vitamin C'
        ],
        'Masker Medis 3 Ply' => [
            'colors' => ['3742FA', '5352ED', '70A1FF'],
            'text' => 'Masker'
        ],
        'Hand Sanitizer 500ml' => [
            'colors' => ['2ED573', '26DE81', 'A4E869'],
            'text' => 'Sanitizer'
        ],
        'Thermometer Digital' => [
            'colors' => ['FC5C65', 'FD79A8', 'FDA7DF'],
            'text' => 'Thermometer'
        ],
        'Suplemen Omega 3' => [
            'colors' => ['6C5CE7', 'A29BFE', '74B9FF'],
            'text' => 'Omega 3'
        ],
        'Madu Murni 500gr' => [
            'colors' => ['F39C12', 'F1C40F', 'F9CA24'],
            'text' => 'Madu'
        ],
        'Teh Herbal Detox' => [
            'colors' => ['27AE60', '2ECC71', '1ABC9C'],
            'text' => 'Teh Herbal'
        ],
        'Plester Luka Waterproof' => [
            'colors' => ['E74C3C', 'C0392B', 'E67E22'],
            'text' => 'Plester'
        ],
        'Obat Maag Cair' => [
            'colors' => ['3498DB', '2980B9', '5DADE2'],
            'text' => 'Obat Maag'
        ],
        'Salep Anti Gatal' => [
            'colors' => ['9B59B6', '8E44AD', 'BB8FCE'],
            'text' => 'Salep'
        ],
        'Obat Tetes Mata' => [
            'colors' => ['1ABC9C', '16A085', '48C9B0'],
            'text' => 'Tetes Mata'
        ],
    ];

    public function run(): void
    {
        $categories = Category::with('product')->get();

        foreach ($categories as $category) {
            $productName = $category->product->name;
            $productConfig = $this->productImages[$productName] ?? [
                'colors' => ['95A5A6', 'BDC3C7', 'ECF0F1'],
                'text' => 'Product'
            ];

            // Create 1-3 images per category
            $imageCount = rand(1, 3);
            
            for ($i = 1; $i <= $imageCount; $i++) {
                $fileName = 'product_' . $category->product_id . '_cat_' . $category->id . '_img_' . $i . '.jpg';
                $filePath = 'products/' . $category->product_id . '/' . $fileName;
                
                // Create directory if not exists
                $productDir = storage_path('app/public/products/' . $category->product_id);
                if (!File::exists($productDir)) {
                    File::makeDirectory($productDir, 0755, true);
                }
                
                // Create unique image for each product
                $colorIndex = ($i - 1) % count($productConfig['colors']);
                $bgColor = $productConfig['colors'][$colorIndex];
                $text = $productConfig['text'] . ' ' . $category->name;
                
                $this->createProductImage(
                    storage_path('app/public/' . $filePath),
                    $bgColor,
                    $text,
                    $i
                );
                
                // Create database record
                ProductImage::create([
                    'category_id' => $category->id,
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'file_size' => rand(100000, 300000), // Random size between 100KB-300KB
                    'mime_type' => 'image/jpeg',
                ]);
            }
        }
    }

    private function createProductImage($path, $bgColor, $text, $variant = 1)
    {
        $width = 400;
        $height = 300;
        
        $image = imagecreatetruecolor($width, $height);
        
        // Convert hex to RGB
        list($r, $g, $b) = sscanf($bgColor, "%02x%02x%02x");
        
        // Colors
        $bgColorResource = imagecolorallocate($image, $r, $g, $b);
        $whiteColor = imagecolorallocate($image, 255, 255, 255);
        $darkColor = imagecolorallocate($image, 50, 50, 50);
        
        // Fill background
        imagefilledrectangle($image, 0, 0, $width, $height, $bgColorResource);
        
        // Add pattern based on variant
        for ($i = 0; $i < $variant * 5; $i++) {
            $x = rand(0, $width);
            $y = rand(0, $height);
            $size = rand(20, 60);
            imagefilledellipse($image, $x, $y, $size, $size, imagecolorallocatealpha($image, 255, 255, 255, 100));
        }
        
        // Add product text
        $font = 5;
        $lines = explode(' ', $text);
        $lineHeight = imagefontheight($font) + 5;
        $totalHeight = count($lines) * $lineHeight;
        $startY = ($height - $totalHeight) / 2;
        
        foreach ($lines as $index => $line) {
            $textWidth = imagefontwidth($font) * strlen($line);
            $x = ($width - $textWidth) / 2;
            $y = $startY + ($index * $lineHeight);
            
            // Text shadow
            imagestring($image, $font, $x + 2, $y + 2, $line, $darkColor);
            // Main text
            imagestring($image, $font, $x, $y, $line, $whiteColor);
        }
        
        // Add variant number
        $variantText = "Variant $variant";
        $variantWidth = imagefontwidth(3) * strlen($variantText);
        imagestring($image, 3, $width - $variantWidth - 10, $height - 20, $variantText, $whiteColor);
        
        // Save image
        imagejpeg($image, $path, 85);
        imagedestroy($image);
    }
}