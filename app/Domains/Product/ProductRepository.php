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

  public function store($productData)
  {
    $productCreated = Product::create($productData);
    return $productCreated;
  }

  public function update($productId, $productData)
  {
    $product = Product::find($productId);
    $product->fill($productData);
    $productUpdated = $product->save();
    return $productUpdated;
  }
}
