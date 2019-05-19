<?php

namespace App;

use App\Product;

class ProductRepository
{
  public function index()
  {
    $products = Product::orderBy('created_at', 'desc')->get();
    $totalOfProducts = Product::all()->count();
    $productsList = (object)[
      'products' => $products,
      'totalOfProducts' => $totalOfProducts
    ];

    return $productsList;
  }
}
