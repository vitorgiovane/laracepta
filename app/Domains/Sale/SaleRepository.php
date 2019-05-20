<?php

namespace App;

use App\Sale;

class SaleRepository
{
  public function index($request = null)
  {
    $pagination = !empty($request->per_page) ? (int)$request->per_page : 10;

    $sales = Sale::orderBy('created_at', 'desc')->with('seller')->paginate($pagination);
    $totalOfSales = Sale::all()->count();
    $salesList = (object)[
      'sales' => $sales,
      'totalOfSales' => $totalOfSales
    ];

    return $salesList;
  }

  public function show($id)
  {
    $sale = Sale::find($id);
    return $sale;
  }

  public function store($saleData)
  {
    $saleCreated = Sale::create($saleData);
    return $saleCreated;
  }

  public function update($id, $saleData)
  {
    $sale = Sale::find($id);
    $sale->fill($saleData);
    $saleUpdated = $sale->save();
    return $saleUpdated;
  }

  public function destroy($id)
  {
    $sale = Sale::find($id);
    $saleDeleted = $sale->delete();
    return $saleDeleted;
  }
}
