<?php

use Faker\Generator as Faker;

$factory->define(App\Feeds::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body'=> $faker->text(200),
        // 'image' => $faker->text(20),
        // 'link'=> $faker->text(20),
        // 'userid'=> '10'
    ];
});
