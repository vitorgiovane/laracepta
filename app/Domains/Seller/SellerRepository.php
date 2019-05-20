<?php

namespace App;

use App\Seller;

class SellerRepository
{
  public function index($request = null)
  {
    $pagination = !empty($request->per_page) ? (int)$request->per_page : 10;

    $sellers = Seller::orderBy('updated_at', 'desc')->paginate($pagination);
    $totalOfSellers = Seller::all()->count();
    $sellersList = (object)[
      'sellers' => $sellers,
      'totalOfSellers' => $totalOfSellers
    ];

    return $sellersList;
  }

  public function show($id)
  {
    $seller = Seller::find($id);
    return $seller;
  }

  public function store($sellerData)
  {
    $sellerCreated = Seller::create($sellerData);
    return $sellerCreated;
  }

  public function update($id, $sellerData)
  {
    $seller = Seller::find($id);
    $seller->fill($sellerData);
    $sellerUpdated = $seller->save();
    return $sellerUpdated;
  }

  public function destroy($id)
  {
    $seller = Seller::find($id);
    $sellerDeleted = $seller->delete();
    return $sellerDeleted;
  }
}
