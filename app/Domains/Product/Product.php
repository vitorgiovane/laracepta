<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'description',
    'quantity',
    'price',
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
   * The Relationship with Product
   *
   */
  public function sales()
  {
    return $this->belongsToMany('App\Sale', 'baskets')->withTimestamps();
  }
}
