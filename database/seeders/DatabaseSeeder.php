<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            ProductImageSeeder::class,
        ]);
        
        $this->command->info('✅ Seeding completed successfully!');
        $this->command->info('📊 Database Statistics:');
        $this->command->info('   - Users: ' . \App\Models\User::count());
        $this->command->info('   - Products: ' . \App\Models\Product::count());
        $this->command->info('   - Categories: ' . \App\Models\Category::count());
        $this->command->info('   - Images: ' . \App\Models\ProductImage::count());
    }
}