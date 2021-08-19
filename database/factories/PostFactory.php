<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {  
    return [
        'title' => $faker->realText(26),
        'user_id' => $faker->numberBetween(1, 100) . "\n",
        'body' => $faker->realText(2500),
        'filename' => "",
      ];
  });
