<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Sale::class, function (Faker $faker) {
  $productsIds = \App\Product::all()->pluck('id');
  $sellersIds = \App\Seller::all()->pluck('id');
  return [
    'quantity' => $faker->randomDigit(),
    'product_id' => $faker->randomElement($productsIds),
    'seller_id' => $faker->randomElement($sellersIds)
  ];
});
