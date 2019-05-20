<?php

namespace App\Exceptions;

use Exception;

class SaleNotCreatedException extends Exception
{
  /**
   * Render the exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function render()
  {
    return 'Aconteceu um erro durante o cadastro da venda. Tente novamente.';
  }
}
