<?php

namespace App;

use Validator;

class SellerValidation
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
      'id' => 'bail|required|digits_between:0,99999999999|exists:products,id'
    ]);
    return $validator;
  }

  public function store($request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'bail|required|min:4|max:80',
      'email' => 'bail|required|email|unique:sellers',
      'picture' => 'bail|required|image|mimes:jpg,jpeg,gif,png|
                    dimensions:min_width=400,min_height=300,max_width:1980,
                    max_heigth:1080'
    ]);
    return $validator;
  }

  public function update($request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'bail|min:4|max:45',
      'email' => 'email|max:45',
      'picture' => 'sometimes|bail|image|mimes:jpg,jpeg,gif,png|
                    dimensions:min_width=400,min_height=300,max_width:1980,
                    max_heigth:1080'
    ]);
    return $validator;
  }

  public function destroy($id)
  {
    $validator = Validator::make(['id' => $id], [
      'id' => 'bail|required|digits_between:0,99999999999|exists:products,id'
    ]);
    return $validator;
  }
}
