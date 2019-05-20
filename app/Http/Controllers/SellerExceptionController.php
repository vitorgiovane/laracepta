<?php

namespace App\Http\Controllers;

class SellerExceptionController extends Controller
{
  public function index()
  {
    $error = session('warning');
    return view('seller.listError', compact('error'));
  }
}
