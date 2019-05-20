<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'quantity',
    'seller_id'
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
   * The Relationship with Seller
   *
   */
  public function seller()
  {
    return $this->belongsTo('App\Seller');
  }

  /**
   * The Relationship with Product
   *
   */
  public function products()
  {
    return $this->belongsToMany('App\Product', 'baskets', 'sale_id', 'product_id')
      ->withTimestamps();
  }
}
