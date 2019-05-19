<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerExceptionController extends Controller
{
  public function index($error = null)
  {
    $error = session('warning');
    return view('seller.listError', compact('error'));
  }
}
