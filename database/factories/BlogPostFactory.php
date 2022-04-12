<?php

use App\Models\BlogPost;
use Faker\Generator as Faker;

$factory->define(BlogPost::class, function (Faker $faker) {
    $name = $faker->sentence(rand(3, 8), true);
    $txt = $faker->realText(rand(1000, 4000));
    $published = rand(1, 5) != 1;
    $created = $faker->dateTimeBetween('-2 months', '-7 days');

    return [
        'category_id' => rand(1, 11),
        'user_id' => rand(1, 2),
        'title' => $name,
        'slug' => str_slug($name),
        'excerpt' => $faker->text(rand(40, 100)),
        'content_raw' => $txt,
        'content_html' => $txt,
        'is_published' => $published,
        'published_at' => $published ? $faker->dateTimeBetween('-2 months', '-1 days') : null,
        'created_at' => $created,
        'updated_at' => $created,
    ];
});
