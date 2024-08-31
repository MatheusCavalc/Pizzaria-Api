<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use inertia\Inertia;
use App\Models\Info;
use App\Models\Category;
use App\Models\Half;
use App\Models\Product;

class AppController extends Controller
{
    public function index()
    {
        $infos = Info::first();
        $categories = Category::with(['products' => function ($query) {
            $query->where('on_sell', true);
        }])->get();
        $promotion = Product::with('category')->where('on_sell', true)->where('on_sale', true)->get();
        $half = Half::where('on_sell', true)->get();

        $cart = session()->get('cart');
        $total_items = $cart == null ? 0 : array_sum(array_map(fn($item) => $item['qty'], $cart));
        $total_value = $cart == null ? '0.00' : number_format(array_sum(array_map(fn($item) => (float)$item['price'], $cart)), 2, '.', '');

        //dd($total_value);

        return Inertia::render(
            'App/Index',
            compact('infos', 'categories', 'promotion', 'half', 'cart', 'total_items', 'total_value')
        );
    }
}
