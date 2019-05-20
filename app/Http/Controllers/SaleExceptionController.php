<?php

namespace App\Http\Controllers;

class SaleExceptionController extends Controller
{
  public function index()
  {
    $error = session('warning');
    return view('product.listError', compact('error'));
  }
}
