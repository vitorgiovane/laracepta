<?php

namespace App;

use Validator;

class SaleValidation
{
  public function index($request)
  {
    $validator = Validator::make($request->all(), [
      'per_page' => 'bail|filled|integer|between:1,50'
    ]);
    return $validator;
  }

  public function show($id)
  {
    $validator = Validator::make(['id' => $id], [
      'id' => 'bail|required|digits_between:0,99999999999|exists:sales,id'
    ]);
    return $validator;
  }

  public function store($request)
  {
    $validator = Validator::make($request->all(), [
      'quantity' => 'bail|required|digits_between:0,99999999999',
      'seller_id' => 'bail|required|digits_between:0,99999999999|exists:sellers,id',
      'chosen_products' => 'bail|required|array'
    ]);
    return $validator;
  }

  public function update($request)
  {
    $validator = Validator::make($request->all(), [
      'quantity' => 'digits_between:0,99999999999',
      'seller_id' => 'bail|digits_between:0,99999999999|exists:sellers,id',
      'chosen_products' => 'array'
    ]);
    return $validator;
  }

  public function destroy($id)
  {
    $validator = Validator::make(['id' => $id], [
      'id' => 'bail|required|digits_between:0,99999999999|exists:sales,id'
    ]);
    return $validator;
  }
}
