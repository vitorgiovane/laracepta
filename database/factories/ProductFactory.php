<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
      'name' => $faker->name(),
      'description' => $faker->text(),
      'quantity' => $faker->numberBetween(2, 10),
      'price' => $faker->randomFloat(2, 10, 99),
      'picture' => $faker->imageUrl(500, 500, 'food')
  ];
});
