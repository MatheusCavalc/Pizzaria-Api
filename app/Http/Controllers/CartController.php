<?php

namespace App\Http\Controllers;

use App\Models\Half;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartView()
    {
        return;
    }

    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $product->name => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => 1,
                    'price' => $product->price,
                    'showInput' => false,
                    'observations' => ''
                ]
            ];
            session()->put('cart', $cart);
        }

        if (isset($cart)) {
            $cart[$product->name] = [
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'showInput' => false,
                'observations' => ''
            ];
            session()->put('cart', $cart);
        }
    }

    public function removeFromCart($product_id)
    {
        //dd($product_id);
        $cart = session()->get('cart');

        foreach ($cart as $key => $item) {
            if ($item['name'] === $product_id) {
                // Remove o produto do carrinho
                unset($cart[$key]);
                break; // Opcional: para de iterar após encontrar e remover o produto
            }
        }

        session()->put('cart', $cart);
    }

    public function combineToCart($product_id_1, $product_id_2)
    {
        $product_1 = Half::findOrFail($product_id_1);

        $product_2 = Half::findOrFail($product_id_2);

        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $product_1->id + $product_2->id => [
                    'id' => $product_1->id + $product_2->id,
                    'name' => 'Pizza Meia ' . $product_1->name . ' + ' . 'Meia ' . $product_2->name,
                    'qty' => 1,
                    'price' => number_format((float)$product_1->price + (float)$product_2->price, 2, '.', ''),
                    'showInput' => false,
                    'observations' => ''
                ]
            ];
            session()->put('cart', $cart);
        }

        if (isset($cart)) {
            $cart[$product_1->id + $product_2->id] = [
                'id' => $product_1->id + $product_2->id,
                'name' => 'Pizza Meia ' . $product_1->name . ' + ' . 'Meia ' . $product_2->name,
                'qty' => 1,
                'price' => number_format((float)$product_1->price + (float)$product_2->price, 2, '.', ''),
                'showInput' => false,
                'observations' => ''
            ];
            session()->put('cart', $cart);
        }
    }
}
