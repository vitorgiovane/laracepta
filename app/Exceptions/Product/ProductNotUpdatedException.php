<?php

namespace App\Exceptions;

use Exception;

class ProductNotUpdatedException extends Exception
{
  /**
   * Render the exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function render()
  {
    return 'Aconteceu um erro durante a atualização do produto. Tente novamente.';
  }
}
