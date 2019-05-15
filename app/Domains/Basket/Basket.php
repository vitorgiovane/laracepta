<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Basket extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'product_id',
    'sale_id'
  ];

  /**
   * The Relationship with Sale
   *
   */
  public function sale()
  {
    return $this->hasOne('App\Domains\Sale\Sale');
  }

  /**
   * Get the products of the basket
   */
  public function basketProducts()
  {
    return $this->hasOne('App\Domains\Product\Product');
  }
}
