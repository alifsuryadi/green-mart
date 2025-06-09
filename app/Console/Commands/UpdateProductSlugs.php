<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Str;

class UpdateProductSlugs extends Command
{
    protected $signature = 'products:update-slugs';
    protected $description = 'Update slugs for existing products';

    public function handle()
    {
        $this->info('Updating product slugs...');
        
        $products = Product::whereNull('slug')->orWhere('slug', '')->get();
        
        foreach ($products as $product) {
            $product->slug = Product::generateUniqueSlug($product->name, $product->user_id, $product->id);
            $product->save();
            
            $this->line("Updated: {$product->name} -> {$product->slug}");
        }
        
        $this->info('Product slugs updated successfully!');
    }
}