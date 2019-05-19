<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\ProductRepository;

class ProductController extends Controller
{
  public function __construct()
  {
    $this->repository = new ProductRepository();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $productsList = $this->repository->index();
    return view('product.list', compact('productsList'));
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

      DB::commit();
      $mensagemDeRetorno = 'Produto cadastrado com sucesso!';
      return redirect()->route('products.index')->with('success', $mensagemDeRetorno);
    } catch (\Exception $e) {
      DB::rollBack();
      $mensagemDeRetorno = 'Aconteceu um erro durante o cadastro do produto. Tente novamente.';
      return redirect()->route('products.create')->with('error', $mensagemDeRetorno);
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
    $product = $this->repository->show($id);
    return view('product.edit', compact('product'));
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

      DB::commit();
      return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    } catch (\Exception $e) {
      DB::rollBack();
      $mensagemDeRetorno = 'Aconteceu um erro durante o cadastro do produto. Tente novamente.';
      return redirect('/products/create')->withErrors($mensagemDeRetorno);
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
    DB::beginTransaction();
    try {
      $this->repository->destroy($id);
      DB::commit();
      $mensagemDeRetorno = 'Produto removido com sucesso!';
      return redirect()->route('products.index')->with('success', $mensagemDeRetorno);
    } catch (\Exception $e) {
      DB::rollBack();
      $mensagemDeRetorno = 'Aconteceu um erro durante a exclusão do produto. Tente novamente.';
      return redirect()->route('products.index')->with('error', $mensagemDeRetorno);
    }
  }
}
