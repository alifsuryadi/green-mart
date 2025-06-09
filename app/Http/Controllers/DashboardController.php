<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalProducts = $user->products()->count();
        $totalCategories = 0;
        $totalImages = 0;

        foreach ($user->products as $product) {
            $totalCategories += $product->categories()->count();
            foreach ($product->categories as $category) {
                $totalImages += $category->images()->count();
            }
        }

        return view('dashboard', compact('totalProducts', 'totalCategories', 'totalImages'));
    }
}