<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Seller;
use App\SellerRepository;
use App\SellerValidation;
use App\Exceptions\SellersGetListException;
use App\Exceptions\SellerNotCreatedException;
use App\Exceptions\SellerNotFoundException;
use App\Exceptions\SellerNotUpdatedException;
use App\Exceptions\SellerNotDeletedException;

class SellerController extends Controller
{
  public function __construct()
  {
    $this->repository = new SellerRepository();
    $this->validation = new SellerValidation();
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
      return redirect()->route('sellers.index')->withErrors($validator);
    }
    try {
      $sellersList = $this->repository->index($request);
      if (empty($sellersList)) {
        throw new SellersGetListException;
      }
      return view('seller.list', compact('sellersList'));
    } catch (\Exception $e) {
      return redirect()->route('sellers.index.exception')->with('error', $e->render());
    }
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('seller.create');
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
        return redirect()->route('sellers.create')->withErrors($validator);
      }
      $sellerData = $request->only(['name', 'email', 'picture']);
      $picture = $request->file('picture');
      $validPictureExtensions = ['jpg', 'png', 'gif', 'jpeg'];
      $pictureExtension = $picture->extension();

      if (!$picture->isValid() || !in_array($pictureExtension, $validPictureExtensions)) {
        $mensagemDeRetorno = 'Imagem inválida! Escolha uma imagem do tipo jpg, jpeg, png ou gif.';
        return redirect()->route('sellers.create')->with('warning', $mensagemDeRetorno);
      }

      DB::beginTransaction();
      try {
        $pictureName = time() . "." . $pictureExtension;
        $picture->storeAs('pictures', $pictureName);
        $sellerData['picture'] = Storage::url('pictures/' . $pictureName);

        $sellerCreated = $this->repository->store($sellerData);
        if (empty($sellerCreated)) {
          throw new SellerNotCreatedException;
        }

        DB::commit();
        $mensagemDeRetorno = 'Vendedor cadastrado com sucesso!';
        return redirect()->route('sellers.index')->with('success', $mensagemDeRetorno);
      } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('sellers.create')->with('error', $e->render());
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
        return redirect()->route('sellers.index')->withErrors($validator);
      }

      try {
        $seller = $this->repository->show($id);
        if (empty($seller)) {
          throw new SellerNotFoundException;
        }
        return view('seller.edit', compact('seller'));
      } catch (\Exception $e) {
        return redirect()->route('sellers.index')->with('error', $e->render());
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
      $seller = Seller::find($id);
      return view('seller.edit', compact('seller'));
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
        return redirect()->route('sellers.edit', ['seller' => $id])->withErrors($validator);
      }
      $sellerData = $request->only(['name', 'email', 'picture']);
      $picture = $request->file('picture');

      if ($picture) {
        $validPictureExtensions = ['jpg', 'png', 'gif', 'jpeg'];

        if (!$picture->isValid() || !in_array($picture->extension(), $validPictureExtensions)) {
          $mensagemDeRetorno = 'Imagem inválida! Escolha uma imagem do tipo jpg, jpeg, png ou gif.';
          return redirect()->route('sellers.update', ['seller' => $id])->with('error', $mensagemDeRetorno);
        }

        $pictureName = time() . "." . $picture->extension();
        $picture->storeAs('pictures', $pictureName);
        $sellerData['picture'] = Storage::url('pictures/' . $pictureName);
      }

      DB::beginTransaction();
      try {
        $sellerUpdated = $this->repository->update($id, $sellerData);
        if (empty($sellerUpdated)) {
          throw new SellerNotUpdatedException;
        }

        DB::commit();
        $successMessage = 'Vendedor atualizado com sucesso!';
        return redirect()->route('sellers.index')->with('success', $successMessage);
      } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('sellers.update', ['seller' => $id])->with('error', $e->render());
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
        return redirect()->route('sellers.index')->withErrors($validator);
      }
      DB::beginTransaction();
      try {
        $sellerDeleted = $this->repository->destroy($id);
        if (empty($sellerDeleted)) {
          throw new SellerNotDeletedException;
        }

        DB::commit();
        $mensagemDeRetorno = 'Vendedor removido com sucesso!';
        return redirect()->route('sellers.index')->with('success', $mensagemDeRetorno);
      } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('sellers.index')->with('error', $e->render());
      }
    }
}
