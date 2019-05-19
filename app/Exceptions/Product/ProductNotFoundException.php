<?php

namespace App\Exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
  /**
   * Render the exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function render()
  {
    return 'Produto não encontrado.';
  }
}
