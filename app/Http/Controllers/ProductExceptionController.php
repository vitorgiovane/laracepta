<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductExceptionController extends Controller
{
  public function index($error = null)
  {
    $error = session('warning');
    return view('product.listError', compact('error'));
  }
}
