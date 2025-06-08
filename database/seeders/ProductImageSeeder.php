<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        // Create dummy images directory
        $dummyPath = storage_path('app/public/dummy');
        if (!File::exists($dummyPath)) {
            File::makeDirectory($dummyPath, 0755, true);
        }

        // Get all categories
        $categories = Category::all();

        foreach ($categories as $category) {
            // Create 1-3 images per category
            $imageCount = rand(1, 3);
            
            for ($i = 1; $i <= $imageCount; $i++) {
                // Create a dummy image file name
                $fileName = 'product_' . $category->product_id . '_cat_' . $category->id . '_img_' . $i . '.jpg';
                $filePath = 'products/' . $category->product_id . '/' . $fileName;
                
                // Create directory if not exists
                $productDir = storage_path('app/public/products/' . $category->product_id);
                if (!File::exists($productDir)) {
                    File::makeDirectory($productDir, 0755, true);
                }
                
                // Copy a placeholder image (you need to add a placeholder.jpg in storage/app/public/dummy/)
                // $placeholderPath = storage_path('app/public/dummy/placeholder.jpg');
                $placeholderPath = public_path('images/placeholder.jpg');
                
                // If placeholder doesn't exist, create a simple one
                if (!File::exists($placeholderPath)) {
                    $this->createPlaceholderImage($placeholderPath);
                }
                
                // Copy placeholder to product directory
                File::copy($placeholderPath, storage_path('app/public/' . $filePath));
                
                // Create database record
                ProductImage::create([
                    'category_id' => $category->id,
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'file_size' => '150000', // 150KB
                    'mime_type' => 'image/jpeg',
                ]);
            }
        }
    }

    private function createPlaceholderImage($path)
    {
        // Create a simple placeholder image using GD library
        $width = 400;
        $height = 300;
        
        $image = imagecreatetruecolor($width, $height);
        
        // Colors
        $bgColor = imagecolorallocate($image, 240, 240, 240);
        $textColor = imagecolorallocate($image, 100, 100, 100);
        $borderColor = imagecolorallocate($image, 200, 200, 200);
        
        // Fill background
        imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);
        
        // Draw border
        imagerectangle($image, 0, 0, $width-1, $height-1, $borderColor);
        
        // Add text
        $text = 'Product Image';
        $fontSize = 5;
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textHeight = imagefontheight($fontSize);
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;
        
        imagestring($image, $fontSize, $x, $y, $text, $textColor);
        
        // Save image
        imagejpeg($image, $path, 80);
        imagedestroy($image);
    }
}