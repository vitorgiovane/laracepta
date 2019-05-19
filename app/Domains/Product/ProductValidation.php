<?php

namespace App;

use Validator;

class ProductValidation
{
  public function index($request)
  { }

  public function show($id)
  {
    $validator = Validator::make(['id' => $id], [
      'id' => 'bail|required|digits_between:0,99999999999|exists:products,id'
    ]);
    return $validator;
  }

  public function store($request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'bail|required|min:4|max:80',
      'price' => 'bail|required|digits_between:0,99999999999',
      'quantity' => 'bail|required|digits_between:0,99999999999',
      'description' => 'bail|required|min:10|max:200',
      'picture' => 'bail|required|image|mimes:jpg,jpeg,gif,png|
                    dimensions:min_width=400,min_height=300,max_width:1980,
                    max_heigth:1080'
    ]);
    return $validator;
  }

  public function update($request)
  { }

  public function destroy($request)
  { }
}
