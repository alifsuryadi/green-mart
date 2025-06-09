<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $categoryCount = $product->categories()->count();
        
        if ($categoryCount >= 3) {
            return back()->with('error', 'Anda Sudah Mencapai Maksimum Input');
        }

        $category = $product->categories()->create([
            'name' => $request->name,
            'description' => $request->description,
            'order_number' => $categoryCount + 1
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category->product);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return back()->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category->product);
        
        DB::transaction(function () use ($category) {
            // Delete all images
            foreach ($category->images as $image) {
                Storage::disk('public')->delete($image->file_path);
            }
            
            $productId = $category->product_id;
            $orderNumber = $category->order_number;
            
            $category->delete();
            
            // Reorder remaining categories
            Category::where('product_id', $productId)
                ->where('order_number', '>', $orderNumber)
                ->decrement('order_number');
        });

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}