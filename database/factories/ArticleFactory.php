<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body'=> $faker->text(200),
        'image' => $faker->text(20),
        'link'=> $faker->text(20),
        'userid'=> $faker->unique()->randomDigit

    ];
    $table->string('title');
    $table->mediumText('body');
    $table->string('image');
    $table->string('link');
    $table->integer('userid');
});