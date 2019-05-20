<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Sale::class, function (Faker $faker) {
  $sellersIds = \App\Seller::all()->pluck('id');
  return [
    'quantity' => $faker->randomDigit(),
    'seller_id' => $faker->randomElement($sellersIds)
  ];
});
