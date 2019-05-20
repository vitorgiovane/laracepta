<?php

namespace App\Http\Controllers;

class ProductExceptionController extends Controller
{
  public function index()
  {
    $error = session('warning');
    return view('product.listError', compact('error'));
  }
}
