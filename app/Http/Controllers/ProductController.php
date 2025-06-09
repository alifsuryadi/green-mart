<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $products = Auth::user()->products()
            ->with(['categories.images'])
            ->orderBy('order_number')
            ->paginate(10);
            
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $productCount = Auth::user()->products()->count();
        
        if ($productCount >= 5) {
            return redirect()->route('products.index')
                ->with('error', 'Anda Sudah Mencapai Maksimum Input');
        }
        
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $productCount = Auth::user()->products()->count();
        
        if ($productCount >= 5) {
            return back()->with('error', 'Anda Sudah Mencapai Maksimum Input');
        }

        $product = Auth::user()->products()->create([
            'name' => $request->name,
            'order_number' => $productCount + 1
        ]);

        return redirect()->route('products.show', $product)
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);
        
        $product->load('categories.images');
        
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $product->update([
            'name' => $request->name
        ]);

        return redirect()->route('products.show', $product)
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        
        DB::transaction(function () use ($product) {
            // Delete all images
            foreach ($product->categories as $category) {
                foreach ($category->images as $image) {
                    Storage::disk('public')->delete($image->file_path);
                }
            }
            
            $userId = $product->user_id;
            $orderNumber = $product->order_number;
            
            $product->delete();
            
            // Reorder remaining products
            Product::where('user_id', $userId)
                ->where('order_number', '>', $orderNumber)
                ->decrement('order_number');
        });

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}