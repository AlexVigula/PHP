<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index(Request $request)
    {
        $currency = strtoupper($request->input('currency', 'RUB'));
        $allowedCurrencies = ['RUB', 'USD', 'EUR'];
        
        if (!in_array($currency, $allowedCurrencies)) {
            $currency = 'RUB'; // Значение по умолчанию при ошибке
        }

        $products = Product::all();
        
        return ProductResource::collection($products)
            ->additional(['currency' => $currency])
            ->setCurrency($currency);
    }
}
