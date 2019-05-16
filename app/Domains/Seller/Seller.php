<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'email',
    'picture'
  ];

  /**
   * The dates that need protection
   *
   * @var array
   */
  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  /**
   * Get the sales of the seller
   */
  public function sellerSales()
  {
    return $this->hasMany('App\Domains\Sale\Sale');
  }
}
