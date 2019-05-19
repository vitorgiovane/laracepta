<?php

namespace App\Exceptions;

use Exception;

class SellersGetListException extends Exception
{
  /**
   * Render the exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function render()
  {
    return 'Falha ao tentar obter a lista de vendedores.';
  }
}
