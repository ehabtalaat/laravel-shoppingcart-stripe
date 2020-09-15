<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Product;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
           'title' => $faker->name,
        'description' => $faker->paragraph,
        'price' => rand(10,300),
         'imagePath' => 'http://ecx.images-amazon.com/images/I/51ZU%2BCvkTyL.jpg',
    ];
});
