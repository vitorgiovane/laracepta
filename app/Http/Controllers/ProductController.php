<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Product;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $products = Product::all();
    $totalOfProducts = Product::all()->count();
    return view('product.list', compact('products', 'totalOfProducts'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('product.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $productData = $request->only(['name', 'description', 'quantity', 'price', 'picture']);
    $picture = $request->file('picture');
    $validPictureExtensions = ['jpg', 'png', 'gif', 'jpeg'];
    $pictureExtension = $picture->extension();
    if (!$picture->isValid() && !in_array($pictureExtension, $validPictureExtensions)) {
      die('Invalid picture!');
    }

    DB::beginTransaction();
    try {
      $pictureName = time() . "." . $pictureExtension;
      $picture->storeAs('pictures', $pictureName);
      $productData['picture'] = Storage::url('pictures/' . $pictureName);

      Product::create($productData);

      DB::commit();
      return $this->index();
    } catch (\Exception $e) {
      DB::rollBack();
      die('Failed');
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
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
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
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
