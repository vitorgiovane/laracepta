<?php

namespace App;

use App\Product;

class ProductRepository
{
  public function index($request = null)
  {
    $pagination = !empty($request->per_page) ? (int)$request->per_page : 10;

    $products = Product::orderBy('created_at', 'desc')->paginate($pagination);
    $totalOfProducts = Product::all()->count();
    $productsList = (object)[
      'products' => $products,
      'totalOfProducts' => $totalOfProducts
    ];

    return $productsList;
  }

  public function show($id)
  {
    $product = Product::find($id);
    return $product;
  }

  public function store($productData)
  {
    $productCreated = Product::create($productData);
    return $productCreated;
  }

  public function update($id, $productData)
  {
    $product = Product::find($id);
    $product->fill($productData);
    $productUpdated = $product->save();
    return $productUpdated;
  }

  public function destroy($id)
  {
    $product = Product::find($id);
    $productDeleted = $product->delete();
    return $productDeleted;
  }
}
