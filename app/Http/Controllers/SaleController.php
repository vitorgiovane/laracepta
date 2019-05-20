<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Sale;
use App\SaleRepository;
use App\ProductRepository;
use App\SellerRepository;
use App\SaleValidation;
use App\Exceptions\SalesGetListException;
use App\Exceptions\SaleNotCreatedException;
use App\Exceptions\SaleNotFoundException;
use App\Exceptions\SaleNotUpdatedException;
use App\Exceptions\SaleNotDeletedException;

class SaleController extends Controller
{
  public function __construct()
  {
    $this->repository = new SaleRepository();
    $this->productRepository = new ProductRepository();
    $this->sellerRepository = new SellerRepository();
    $this->validation = new SaleValidation();
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $validator = $this->validation->index($request);
    if ($validator->fails()) {
      return redirect()->route('sales.index')->withErrors($validator);
    }
    try {
      $salesList = $this->repository->index($request);

      if (empty($salesList)) {
        throw new SalesGetListException;
      }
      return view('sale.list', compact('salesList'));
    } catch (\Exception $e) {
      return redirect()->route('sales.index.exception')->with('error', $e->render());
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $sellers = $this->sellerRepository->index()->sellers;
    $products = $this->productRepository->index()->products;
    return view('sale.create', compact('sellers', 'products'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = $this->validation->store($request);
    if ($validator->fails()) {
      return redirect()->route('sales.create')->withErrors($validator);
    }
    $saleData = $request->only(['quantity', 'seller_id']);
    $chosenProducts = array_values($request->only(['chosen_products']))[0];

    DB::beginTransaction();
    try {

      $saleCreated = $this->repository->store($saleData);
      $saleCreated->products()->attach($chosenProducts);

      if (empty($saleCreated)) {
        throw new SaleNotCreatedException;
      }

      DB::commit();
      $mensagemDeRetorno = 'Venda cadastrada com sucesso!';
      return redirect()->route('sales.index')->with('success', $mensagemDeRetorno);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->route('sales.create')->with('error', $e->render());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $validator = $this->validation->show($id);
    if ($validator->fails()) {
      return redirect()->route('sales.index')->withErrors($validator);
    }

    try {
      $sale = $this->repository->show($id);
      $basket = [];
      foreach ($sale->products as $product) {
        $basket[] = $product->id;
      }
      $sellers = $this->sellerRepository->index()->sellers;
      $products = $this->productRepository->index()->products;
      if (empty($sale)) {
        throw new ProductNotFoundException;
      }
      return view('sale.edit', compact('sale', 'sellers', 'products', 'basket'));
    } catch (\Exception $e) {
      return redirect()->route('sales.index')->with('error', $e->render());
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $validator = $this->validation->show($id);
    if ($validator->fails()) {
      return redirect()->route('sales.index')->withErrors($validator);
    }

    try {
      $sale = $this->repository->show($id);
      $basket = [];
      foreach ($sale->products as $product) {
        $basket[] = $product->id;
      }
      $sellers = $this->sellerRepository->index()->sellers;
      $products = $this->productRepository->index()->products;
      if (empty($sale)) {
        throw new ProductNotFoundException;
      }
      return view('sale.edit', compact('sale', 'sellers', 'products', 'basket'));
    } catch (\Exception $e) {
      return redirect()->route('sales.index')->with('error', $e->render());
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $validator = $this->validation->update($request);
    if ($validator->fails()) {
      return redirect()->route('sales.create')->withErrors($validator);
    }
    $saleData = $request->only(['quantity', 'seller_id']);
    $chosenProducts = array_values($request->only(['chosen_products']))[0];

    DB::beginTransaction();
    try {

      $saleUpdated = $this->repository->update($id, $saleData);
      $sale = $this->repository->show($id);
      $sale->products()->sync($chosenProducts);

      if (empty($saleUpdated)) {
        throw new SaleNotUpdatedException;
      }

      DB::commit();
      $mensagemDeRetorno = 'Venda atualizada com sucesso!';
      return redirect()->route('sales.index')->with('success', $mensagemDeRetorno);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->route('sales.update', ['sale' => $id])->with('error', $e->render());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $validator = $this->validation->destroy($id);
    if ($validator->fails()) {
      return redirect()->route('sales.index')->withErrors($validator);
    }
    DB::beginTransaction();
    try {
      $saleDeleted = $this->repository->destroy($id);
      if (empty($saleDeleted)) {
        throw new SaleNotDeletedException;
      }

      DB::commit();
      $mensagemDeRetorno = 'Venda removida com sucesso!';
      return redirect()->route('sales.index')->with('success', $mensagemDeRetorno);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->route('sales.index')->with('error', $e->render());
    }
  }
}
