<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ImageController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request, Category $category)
    {
        $this->authorize('update', $category->product);
        
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('products/' . $category->product_id, $fileName, 'public');
            
            $image = $category->images()->create([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'image' => $image,
                    'url' => $image->full_path
                ]);
            }

            return back()->with('success', 'Gambar berhasil diupload');
        }

        return back()->with('error', 'Gagal mengupload gambar');
    }

    public function destroy(ProductImage $image)
    {
        $this->authorize('delete', $image->category->product);
        
        Storage::disk('public')->delete($image->file_path);
        $image->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Gambar berhasil dihapus');
    }
}