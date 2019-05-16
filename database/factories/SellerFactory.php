<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Seller::class, function (Faker $faker) {
  return [
    'name' => $faker->name(),
    'email' => $faker->email(),
    'picture' => $faker->imageUrl(500, 500, 'people')
  ];
});

