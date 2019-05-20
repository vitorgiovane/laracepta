<?php

namespace App\Exceptions;

use Exception;

class SaleNotFoundException extends Exception
{
  /**
   * Render the exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function render()
  {
    return 'Venda não encontrada.';
  }
}
