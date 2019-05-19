<?php

namespace App\Exceptions;

use Exception;

class ProductsGetListException extends Exception
{
  /**
   * Render the exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function render()
  {
    $message = 'Falha ao tentar obter a lista de produtos.';
    return $message;
  }
}
