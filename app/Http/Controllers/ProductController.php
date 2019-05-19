<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\ProductRepository;
use App\ProductValidation;
use App\Exceptions\ProductsGetListException;
use App\Exceptions\ProductNotCreatedException;
use App\Exceptions\ProductNotFoundException;
use App\Exceptions\ProductNotUpdatedException;
use App\Exceptions\ProductNotDeletedException;

class ProductController extends Controller
{
  public function __construct()
  {
    $this->repository = new ProductRepository();
    $this->validation = new ProductValidation();
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
      return redirect()->route('products.index')->withErrors($validator);
    }
    try {
      $productsList = $this->repository->index($request);
      if (empty($productsList)) {
        throw new ProductsGetListException;
      }
      return view('product.list', compact('productsList'));
    } catch (\Exception $e) {
      return redirect()->route('products.index.exception')->with('error', $e->render());
    }
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
    $validator = $this->validation->store($request);
    if ($validator->fails()) {
      return redirect()->route('products.create')->withErrors($validator);
    }
    $productData = $request->only(['name', 'description', 'quantity', 'price', 'picture']);
    $picture = $request->file('picture');
    $validPictureExtensions = ['jpg', 'png', 'gif', 'jpeg'];
    $pictureExtension = $picture->extension();

    if (!$picture->isValid() || !in_array($pictureExtension, $validPictureExtensions)) {
      $mensagemDeRetorno = 'Imagem inválida! Escolha uma imagem do tipo jpg, jpeg, png ou gif.';
      return redirect()->route('products.create')->with('warning', $mensagemDeRetorno);
    }

    DB::beginTransaction();
    try {
      $pictureName = time() . "." . $pictureExtension;
      $picture->storeAs('pictures', $pictureName);
      $productData['picture'] = Storage::url('pictures/' . $pictureName);

      $productCreated = $this->repository->store($productData);
      if (empty($productCreated)) {
        throw new ProductNotCreatedException;
      }

      DB::commit();
      $mensagemDeRetorno = 'Produto cadastrado com sucesso!';
      return redirect()->route('products.index')->with('success', $mensagemDeRetorno);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->route('products.create')->with('error', $e->render());
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
      return redirect()->route('products.index')->withErrors($validator);
    }

    try {
      $product = $this->repository->show($id);
      if (empty($product)) {
        throw new ProductNotFoundException;
      }
      return view('product.edit', compact('product'));
    } catch (\Exception $e) {
      return redirect()->route('products.index')->with('error', $e->render());
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
    $product = Product::find($id);
    return view('product.edit', compact('product'));
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
      return redirect()->route('products.edit', ['product' => $id])->withErrors($validator);
    }
    $productData = $request->only(['name', 'description', 'quantity', 'price', 'picture']);
    $picture = $request->file('picture');

    if ($picture) {
      $validPictureExtensions = ['jpg', 'png', 'gif', 'jpeg'];

      if (!$picture->isValid() || !in_array($picture->extension(), $validPictureExtensions)) {
        $mensagemDeRetorno = 'Imagem inválida! Escolha uma imagem do tipo jpg, jpeg, png ou gif.';
        return redirect()->route('products.update', ['product' => $id])->with('error', $mensagemDeRetorno);
      }

      $pictureName = time() . "." . $picture->extension();
      $picture->storeAs('pictures', $pictureName);
      $productData['picture'] = Storage::url('pictures/' . $pictureName);
    }

    DB::beginTransaction();
    try {
      $productUpdated = $this->repository->update($id, $productData);
      if (empty($productUpdated)) {
        throw new ProductNotUpdatedException;
      }

      DB::commit();
      $successMessage = 'Produto atualizado com sucesso!';
      return redirect()->route('products.index')->with('success', $successMessage);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->route('products.update', ['product' => $id])->with('error', $e->render());
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
      return redirect()->route('products.index')->withErrors($validator);
    }
    DB::beginTransaction();
    try {
      $productDeleted = $this->repository->destroy($id);
      if (empty($productDeleted)) {
        throw new ProductNotDeletedException;
      }

      DB::commit();
      $mensagemDeRetorno = 'Produto removido com sucesso!';
      return redirect()->route('products.index')->with('success', $mensagemDeRetorno);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->route('products.index')->with('error', $e->render());
    }
  }
}
